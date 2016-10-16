@extends('layouts/default')

{{-- Page title --}}
@section('title')
@if ($item->id)
{{ trans('admin/licenses/form.update') }}
@else
{{ trans('admin/licenses/form.create') }}
@endif
@parent
@stop

@section('header_right')
<a href="{{ URL::previous() }}" class="btn btn-primary pull-right">
    {{ trans('general.back') }}</a>
    @stop


    {{-- Page content --}}
    @section('content')


    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- Horizontal Form -->
            <div class="box box-default">
                @if ($item->id)
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $item->name }}</h3>
                </div><!-- /.box-header -->
                @endif
                <!-- form start -->
                <form class="form-horizontal" method="post" autocomplete="off">

                    {{ csrf_field() }}

                    <div class="box-body">

                        @include ('partials.forms.edit.name', ['translated_name' => trans('admin/licenses/form.name')])

                        <!-- Serial-->
                        <div class="form-group {{ $errors->has('serial') ? ' has-error' : '' }}">
                            <label for="serial" class="col-md-3 control-label">{{ trans('admin/licenses/form.license_key') }}</label>
                            <div class="col-md-7{{  (\App\Helpers\Helper::checkIfRequired($item, 'serial')) ? ' required' : '' }}">
                                <textarea class="form-control" type="text" name="serial" id="serial">{{ Input::old('serial', $item->serial) }}</textarea>
                                {!! $errors->first('serial', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        <!-- Seats -->
                        <div class="form-group {{ $errors->has('seats') ? ' has-error' : '' }}">
                            <label for="seats" class="col-md-3 control-label">{{ trans('admin/licenses/form.seats') }}</label>
                            <div class="col-md-7 col-sm-12 required">
                                <div class="col-md-2" style="padding-left:0px">
                                    <input class="form-control" type="text" name="seats" id="seats" value="{{ Input::old('seats', $item->seats) }}" />
                                </div>
                            </div>
                            {!! $errors->first('seats', '<div class="col-md-8 col-md-offset-3"><span class="alert-msg"><i class="fa fa-times"></i> :message</span></div>') !!}
                        </div>

                        @include ('partials.forms.edit.company')
                        @include ('partials.forms.edit.manufacturer')

                        <!-- Licensed to name -->
                        <div class="form-group {{ $errors->has('license_name') ? ' has-error' : '' }}">
                            <label for="license_name" class="col-md-3 control-label">{{ trans('admin/licenses/form.to_name') }}</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" name="license_name" id="license_name" value="{{ Input::old('license_name', $item->license_name) }}" />
                                {!! $errors->first('license_name', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        <!-- Licensed to email -->
                        <div class="form-group {{ $errors->has('license_email') ? ' has-error' : '' }}">
                            <label for="license_email" class="col-md-3 control-label">{{ trans('admin/licenses/form.to_email') }}</label>
                            <div class="col-md-7">
                                <input class="form-control" type="text" name="license_email" id="license_email" value="{{ Input::old('license_email', $item->license_email) }}" />
                                {!! $errors->first('license_email', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        <!-- Reassignable -->
                        <div class="form-group {{ $errors->has('reassignable') ? ' has-error' : '' }}">
                            <label for="reassignable" class="col-md-3 control-label">{{ trans('admin/licenses/form.reassignable') }}</label>
                            <div class="col-md-7 input-group">
                                {{ Form::Checkbox('reassignable', '1', Input::old('reassignable', $item->id ? $item->reassignable : '1'),array('class' => 'minimal')) }}
                                {{ trans('general.yes') }}
                            </div>
                        </div>


                        @include ('partials.forms.edit.supplier')
                        @include ('partials.forms.edit.order_number')
                        @include ('partials.forms.edit.purchase_cost')
                        @include ('partials.forms.edit.purchase_date')

                        <!-- Expiration Date -->
                        <div class="form-group {{ $errors->has('expiration_date') ? ' has-error' : '' }}">
                            <label for="expiration_date" class="col-md-3 control-label">{{ trans('admin/licenses/form.expiration') }}</label>
                            <div class="input-group col-md-3">
                                <div class="input-group">
                                    <input type="text" class="datepicker form-control" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="expiration_date" id="expiration_date" value="{{ Input::old('expiration_date', $item->expiration_date) }}">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div><!-- /.input group -->

                                {!! $errors->first('expiration_date', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        <!-- Termination Date -->
                        <div class="form-group {{ $errors->has('termination_date') ? ' has-error' : '' }}">
                            <label for="termination_date" class="col-md-3 control-label">{{ trans('admin/licenses/form.termination_date') }}</label>
                            <div class="input-group col-md-3">
                                <div class="input-group">

                                    <input type="text" class="datepicker form-control" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" name="termination_date" id="expiration_date" value="{{ Input::old('termination_date', $item->termination_date) }}">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div><!-- /.input group -->


                                {!! $errors->first('termination_date', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        {{-- @TODO How does this differ from Order #? --}}
                        <!-- Purchase Order -->
                        <div class="form-group {{ $errors->has('purchase_order') ? ' has-error' : '' }}">
                            <label for="purchase_order" class="col-md-3 control-label">{{ trans('admin/licenses/form.purchase_order') }}</label>
                            <div class="col-md-3">
                                <input class="form-control" type="text" name="purchase_order" id="purchase_order" value="{{ Input::old('purchase_order', $item->purchase_order) }}" />
                                {!! $errors->first('purchase_order', '<span class="alert-msg"><i class="fa fa-times"></i> :message</span>') !!}
                            </div>
                        </div>

                        @include ('partials.forms.edit.depreciation')

                        <!-- Maintained -->
                        <div class="form-group {{ $errors->has('maintained') ? ' has-error' : '' }}">
                            <label for="maintained" class="col-md-3 control-label">{{ trans('admin/licenses/form.maintained') }}</label>
                            <div class="checkbox col-md-7">
                                {{ Form::Checkbox('maintained', '1', Input::old('maintained', $item->maintained),array('class' => 'minimal')) }}
                                {{ trans('general.yes') }}
                            </div>
                        </div>

                        @include ('partials.forms.edit.notes')

                    </div><!-- /.box-body -->
                    @include ('partials.forms.edit.submit')
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    @stop
