<?php

namespace App\Http\Controllers\Assets;

use App\Models\Actionlog;
use App\Helpers\Helper;
use App\Http\Controllers\CheckInOutRequest;
use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetModel;
use App\Models\Company;
use App\Models\Location;
use App\Models\Setting;
use App\Models\Supplier;
use App\View\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AssetCheckoutRequest;

class BulkAssetsController extends Controller
{
    use CheckInOutRequest;

    /**
     * Display the bulk edit page.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @return View
     * @internal param int $assetId
     * @since [v2.0]
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Request $request)
    {
        $this->authorize('view', Asset::class);

        if (! $request->filled('ids')) {
            return redirect()->back()->with('error', trans('admin/hardware/message.update.no_assets_selected'));
        }

        // Figure out where we need to send the user after the update is complete, and store that in the session
        $bulk_back_url = request()->headers->get('referer');
        session(['bulk_back_url' => $bulk_back_url]);

        $asset_ids = array_values(array_unique($request->input('ids')));

        if ($request->filled('bulk_actions')) {
            switch ($request->input('bulk_actions')) {
                case 'labels':
                    $this->authorize('view', Asset::class);
                    return (new Label)
                        ->with('assets', Asset::find($asset_ids))
                        ->with('settings', Setting::getSettings())
                        ->with('bulkedit', true)
                        ->with('count', 0);

                case 'delete':
                    $this->authorize('delete', Asset::class);
                    $assets = Asset::with('assignedTo', 'location')->find($asset_ids);
                    $assets->each(function ($asset) {
                        $this->authorize('delete', $asset);
                    });

                    return view('hardware/bulk-delete')->with('assets', $assets);
                   
                case 'restore':
                    $this->authorize('update', Asset::class);
                    $assets = Asset::withTrashed()->find($asset_ids); 
                    $assets->each(function ($asset) {
                        $this->authorize('delete', $asset);
                    });

                    return view('hardware/bulk-restore')->with('assets', $assets);

                case 'edit':
                    $this->authorize('update', Asset::class);
                    return view('hardware/bulk')
                        ->with('assets', $asset_ids)
                        ->with('statuslabel_list', Helper::statusLabelList());
            }
        }

        return redirect()->back()->with('error', 'No action selected');
    }

    /**
     * Save bulk edits
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @return Redirect
     * @internal param array $assets
     * @since [v2.0]
     */
    public function update(Request $request)
    {
        $this->authorize('update', Asset::class);

        // Get the back url from the session and then destroy the session
        $bulk_back_url = route('hardware.index');
        if ($request->session()->has('bulk_back_url')) {
            $bulk_back_url = $request->session()->pull('bulk_back_url');
        }


        if (! $request->filled('ids') || count($request->input('ids')) <= 0) {
            return redirect($bulk_back_url)->with('error', trans('admin/hardware/message.update.no_assets_selected'));
        }

        $assets = array_keys($request->input('ids'));

        if (($request->filled('purchase_date'))
            || ($request->filled('expected_checkin'))
            || ($request->filled('purchase_cost'))
            || ($request->filled('supplier_id'))
            || ($request->filled('order_number'))
            || ($request->filled('warranty_months'))
            || ($request->filled('rtd_location_id'))
            || ($request->filled('requestable'))
            || ($request->filled('company_id'))
            || ($request->filled('status_id'))
            || ($request->filled('model_id'))
            || ($request->filled('next_audit_date'))
            || ($request->filled('null_purchase_date'))
            || ($request->filled('null_expected_checkin_date'))
            || ($request->filled('null_next_audit_date'))

        ) {
            foreach ($assets as $assetId) {

                $this->update_array = [];

                $this->conditionallyAddItem('purchase_date')
                    ->conditionallyAddItem('expected_checkin')
                    ->conditionallyAddItem('model_id')
                    ->conditionallyAddItem('order_number')
                    ->conditionallyAddItem('requestable')
                    ->conditionallyAddItem('status_id')
                    ->conditionallyAddItem('supplier_id')
                    ->conditionallyAddItem('warranty_months')
                    ->conditionallyAddItem('next_audit_date');

                if ($request->input('null_purchase_date')=='1') {
                    $this->update_array['purchase_date'] = null;
                }

                if ($request->input('null_expected_checkin_date')=='1') {
                    $this->update_array['expected_checkin'] = null;
                }

                if ($request->input('null_next_audit_date')=='1') {
                    $this->update_array['next_audit_date'] = null;
                }

                if ($request->filled('purchase_cost')) {
                    $this->update_array['purchase_cost'] =  $request->input('purchase_cost');
                }

                if ($request->filled('company_id')) {
                    $this->update_array['company_id'] = $request->input('company_id');
                    if ($request->input('company_id') == 'clear') {
                        $this->update_array['company_id'] = null;
                    }
                }

                if ($request->filled('rtd_location_id')) {
                    $this->update_array['rtd_location_id'] = $request->input('rtd_location_id');
                    if (($request->filled('update_real_loc')) && (($request->input('update_real_loc')) == '1')) {
                        $this->update_array['location_id'] = $request->input('rtd_location_id');
                    }
                }

                $changed = [];
                $asset = Asset::where('id' ,$assetId)->get();

                foreach ($this->update_array as $key => $value) {
                    if ($this->update_array[$key] != $asset->toArray()[0][$key]) {
                        $changed[$key]['old'] = $asset->toArray()[0][$key];
                        $changed[$key]['new'] = $this->update_array[$key];
                    }
                }
                $changed= $this->bulkChangedInfo($changed);

                $logAction = new Actionlog();
                $logAction->item_type = Asset::class;
                $logAction->item_id = $assetId;
                $logAction->created_at =  date("Y-m-d H:i:s");
                $logAction->user_id = Auth::id();
                $logAction->log_meta = json_encode($changed);
                $logAction->logaction('update');

                DB::table('assets')
                    ->where('id', $assetId)
                    ->update($this->update_array);
            } // endforeach

            return redirect($bulk_back_url)->with('success', trans('admin/hardware/message.update.success'));


        }

        // no values given, nothing to update
        return redirect($bulk_back_url)->with('warning', trans('admin/hardware/message.update.nothing_updated'));
    }
    /**
     * This takes the ids of the changed attributes and returns the names instead for the history view of an Asset
     *
     * @param  array $changed
     * @return array
     */
    public function bulkChangedInfo(array $changed){

        if(array_key_exists('rtd_location_id',$changed)) {
            $changed['rtd_location_id']['old'] = $changed['rtd_location_id']['old'] ? Location::find($changed['rtd_location_id']['old'])->name : trans('general.unassigned');
            $changed['rtd_location_id']['new'] = $changed['rtd_location_id']['new'] ? Location::find($changed['rtd_location_id']['new'])->name : trans('general.unassigned');
            $changed['Default Location'] = $changed['rtd_location_id'];
            unset($changed['rtd_location_id']);
        }
        if(array_key_exists('location_id', $changed)) {
            $changed['location_id']['old'] = $changed['location_id']['old'] ? Location::find($changed['location_id']['old'])->name : trans('general.unassigned');
            $changed['location_id']['new'] = $changed['location_id']['new'] ? Location::find($changed['location_id']['new'])->name : trans('general.unassigned');
            $changed['Current Location'] = $changed['location_id'];
            unset($changed['location_id']);
        }
        if(array_key_exists('model_id', $changed)) {
            $changed['model_id']['old'] = AssetModel::find($changed['model_id']['old'])->name;
            $changed['model_id']['new'] = AssetModel::find($changed['model_id']['new'])->name; /* model is required at asset creation */
            $changed['Model'] = $changed['model_id'];
            unset($changed['model_id']);
        }
        if(array_key_exists('company_id', $changed)) {
            $changed['company_id']['old'] = $changed['company_id']['old'] ? Company::find($changed['company_id']['old'])->name : trans('general.unassigned');
            $changed['company_id']['new'] = $changed['company_id']['new'] ? Company::find($changed['company_id']['new'])->name : trans('general.unassigned');
            $changed['Company'] = $changed['company_id'];
            unset($changed['company_id']);
        }
        if(array_key_exists('supplier_id', $changed)) {
            $changed['supplier_id']['old'] = $changed['supplier_id']['old'] ? Supplier::find($changed['supplier_id']['old'])->name : trans('general.unassigned');
            $changed['supplier_id']['new'] = $changed['supplier_id']['new'] ? Supplier::find($changed['supplier_id']['new'])->name : trans('general.unassigned');
            $changed['Supplier'] = $changed['supplier_id'];
            unset($changed['supplier_id']);
        }

        return $changed;

    }

    /**
     * Array to store update data per item
     * @var array
     */
    private $update_array;

    /**
     * Adds parameter to update array for an item if it exists in request
     * @param  string $field field name
     * @return BulkAssetsController Model for Chaining
     */
    protected function conditionallyAddItem($field)
    {
        if (request()->filled($field)) {
            $this->update_array[$field] = request()->input($field);
        }

        return $this;
    }

    /**
     * Save bulk deleted.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param Request $request
     * @return View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @internal param array $assets
     * @since [v2.0]
     */
    public function destroy(Request $request)
    {
        $this->authorize('delete', Asset::class);

        $bulk_back_url = route('hardware.index');
        if ($request->session()->has('bulk_back_url')) {
            $bulk_back_url = $request->session()->pull('bulk_back_url');
        }

        if ($request->filled('ids')) {
            $assets = Asset::find($request->get('ids'));
            foreach ($assets as $asset) {
                $update_array['deleted_at'] = date('Y-m-d H:i:s');
                $update_array['assigned_to'] = null;

                DB::table('assets')
                    ->where('id', $asset->id)
                    ->update($update_array);
            } // endforeach

            return redirect($bulk_back_url)->with('success', trans('admin/hardware/message.delete.success'));
            // no values given, nothing to update
        }

        return redirect($bulk_back_url)->with('error', trans('admin/hardware/message.delete.nothing_updated'));
    }

    /**
     * Show Bulk Checkout Page
     * @return View View to checkout multiple assets
     */
    public function showCheckout()
    {
        $this->authorize('checkout', Asset::class);
        // Filter out assets that are not deployable.

        return view('hardware/bulk-checkout');
    }

    /**
     * Process Multiple Checkout Request
     * @return View
     */
    public function storeCheckout(AssetCheckoutRequest $request)
    {

        $this->authorize('checkout', Asset::class);

        try {
            $admin = Auth::user();

            $target = $this->determineCheckoutTarget();

            if (! is_array($request->get('selected_assets'))) {
                return redirect()->route('hardware.bulkcheckout.show')->withInput()->with('error', trans('admin/hardware/message.checkout.no_assets_selected'));
            }

            $asset_ids = array_filter($request->get('selected_assets'));

            if (request('checkout_to_type') == 'asset') {
                foreach ($asset_ids as $asset_id) {
                    if ($target->id == $asset_id) {
                        return redirect()->back()->with('error', 'You cannot check an asset out to itself.');
                    }
                }
            }
            $checkout_at = date('Y-m-d H:i:s');
            if (($request->filled('checkout_at')) && ($request->get('checkout_at') != date('Y-m-d'))) {
                $checkout_at = e($request->get('checkout_at'));
            }

            $expected_checkin = '';

            if ($request->filled('expected_checkin')) {
                $expected_checkin = e($request->get('expected_checkin'));
            }

            $errors = [];
            DB::transaction(function () use ($target, $admin, $checkout_at, $expected_checkin, $errors, $asset_ids, $request) {
                foreach ($asset_ids as $asset_id) {
                    $asset = Asset::findOrFail($asset_id);
                    $this->authorize('checkout', $asset);

                    $error = $asset->checkOut($target, $admin, $checkout_at, $expected_checkin, e($request->get('note')), $asset->name, null);

                    if ($target->location_id != '') {
                        $asset->location_id = $target->location_id;
                        $asset->unsetEventDispatcher();
                        $asset->save();
                    }

                    if ($error) {
                        array_merge_recursive($errors, $asset->getErrors()->toArray());
                    }
                }
            });

            if (! $errors) {
                // Redirect to the new asset page
                return redirect()->to('hardware')->with('success', trans('admin/hardware/message.checkout.success'));
            }
            // Redirect to the asset management page with error
            return redirect()->route('hardware.bulkcheckout.show')->with('error', trans('admin/hardware/message.checkout.error'))->withErrors($errors);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('hardware.bulkcheckout.show')->with('error', $e->getErrors());
        }
        
    }
    public function restore(Request $request) {
        $this->authorize('update', Asset::class);
       $assetIds = $request->get('ids');
      if (empty($assetIds)) {
          return redirect()->route('hardware.index')->with('error', trans('admin/hardware/message.restore.nothing_updated'));
        } else {
            foreach ($assetIds as $key => $assetId) {
                    $asset = Asset::withTrashed()->find($assetId);
                    $asset->restore(); 
            } 
        return redirect()->route('hardware.index')->with('success', trans('admin/hardware/message.restore.success'));
        }
    }
}
