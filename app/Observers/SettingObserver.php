<?php

namespace App\Observers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
    /**
     * Listen to the Setting saved event.
     *
     * @param Setting $setting
     *
     * @return void
     */
    public function saved(Setting $setting)
    {
        $setting->logAdmin(actionType: 'saved', note: 'settings observer'); 
        Cache::forget(Setting::SETUP_CHECK_KEY);
    }
}
