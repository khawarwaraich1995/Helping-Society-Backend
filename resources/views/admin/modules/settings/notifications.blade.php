@extends('admin.layouts.app', ['title' => __('Notifications Settings')])

@section('content')
    @include('admin.layouts.partials.header', [
    'title' => __('Notifications Settings'),
    'class' => 'col-lg-12',
    ])
    <?php
    $submit_url = route('admin:update-notifications-settings');
    ?>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Notifications Settings Form') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="smtp_form" method="post" action="{{ $submit_url }}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <h4 class="heading-medium text-black font-weight-bold mb-4">
                                    {{ __('Onesignal Account Information') }}</h4>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                @php
                                                    if (isset($settings->notifications_enabled) && $settings->notifications_enabled === 1) {
                                                        $check = 'checked';
                                                    } else {
                                                        $check = '';
                                                    }
                                                @endphp
                                                <input type="checkbox" {{ $check }} class="custom-control-input"
                                                    name="notifications_enabled" id="notifications_enabled">
                                                <label class="custom-control-label" for="notifications_enabled">{{ __('System should send notifications') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Onesignal App ID') }}</label>
                                            <input class="form-control form-control-alternative" type="text"
                                                value="{{ old('onesignal_app_id', $settings->onesignal_app_id ?? '') }}"
                                                id="onesignal_app_id" name="onesignal_app_id">
                                            @error('onesignal_app_id')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Onesignal rest api key') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text"
                                                value="{{ old('onesignal_restApi_key', $settings->onesignal_restApi_key ?? '') }}"
                                                id="onesignal_restApi_key" name="onesignal_restApi_key">
                                            @error('onesignal_restApi_key')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <div class="row">
                                <div class="col-lg-2 col-md-2">
                                    <a class="btn btn-icon btn-success" href="{{ route('admin:dashboard') }}" id="back">
                                        <span class="btn-inner--icon"><i class="ni ni-bold-left"></i></span>
                                        <span class="btn-inner--text">{{ __('Back') }}</span>
                                    </a>
                                </div>
                                <div class="col-lg-2 col-md-2 offset-lg-8">
                                    <button class="btn btn-icon btn-success" type="submit" id="save">
                                        <span class="btn-inner--icon"><i class="ni ni-check-bold"></i></span>
                                        <span class="btn-inner--text">{{ __('Save') }}</span>
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layouts.footers.auth')
    </div>
@endsection


@push('js')
    <script src="{{ asset('argon') }}/js/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#save").on('click', function() {
                $("#smtp_form").validate({
                    rules: {
                        onesignal_app_id: {
                            required: true,
                        },
                        onesignal_restApi_key: {
                            required: true
                        }
                    }
                });
            });

        });
    </script>
@endpush
