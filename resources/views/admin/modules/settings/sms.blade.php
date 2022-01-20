@extends('admin.layouts.app', ['title' => __('SMS Setting')])

@section('content')
    @include('admin.layouts.partials.header', [
    'title' => __('SMS Setting'),
    'class' => 'col-lg-12',
    ])
    <?php
    $submit_url = route('admin:update-sms-settings');
    ?>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('SMS Setting Form') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="smtp_form" method="post" action="{{ $submit_url }}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <h4 class="heading-medium text-black font-weight-bold mb-4">
                                    {{ __('Twilio Account Information') }}</h4>
                                <hr>
                                <div class="row mt-5">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                @php
                                                    if (isset($settings->sms_enabled) && $settings->sms_enabled === 1) {
                                                        $check = 'checked';
                                                    } else {
                                                        $check = '';
                                                    }
                                                @endphp
                                                <label class="custom-control-label"
                                                    for="sms_enabled">{{ __('System should send sms notifications') }}</label>
                                                <input type="checkbox" {{ $check }} class="custom-control-input"
                                                    name="sms_enabled" id="sms_enabled">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Twillo Account SID') }}</label>
                                            <input class="form-control form-control-alternative" type="text"
                                                value="{{ old('twilio_sid', $settings->twilio_sid ?? '') }}"
                                                id="twilio_sid" name="twilio_sid">
                                            @error('twilio_sid')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Twillo Account auth token') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text"
                                                value="{{ old('twilio_auth_token', $settings->twilio_auth_token ?? '') }}"
                                                id="twilio_auth_token" name="twilio_auth_token">
                                            @error('twilio_auth_token')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Twillo from number') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text"
                                                value="{{ old('twilio_from_no', $settings->twilio_from_no ?? '') }}"
                                                id="twilio_from_no" name="twilio_from_no">
                                            @error('twilio_from_no')
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
                        twilio_sid: {
                            required: true
                        },
                        twilio_auth_token: {
                            required: true
                        },
                        twilio_from_no: {
                            required: true,
                        }
                    }
                });
            });

        });
    </script>
@endpush
