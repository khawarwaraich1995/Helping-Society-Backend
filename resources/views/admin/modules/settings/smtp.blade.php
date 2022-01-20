@extends('admin.layouts.app', ['title' => __('SMTP Setting')])

@section('content')
    @include('admin.layouts.partials.header', [
    'title' => __('SMTP Setting'),
    'class' => 'col-lg-12',
    ])
    <?php
    $submit_url = route('admin:update-smtp-settings');
    ?>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('SMTP Settings Form') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="smtp_form" method="post" action="{{ $submit_url }}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <h4 class="heading-medium text-black font-weight-bold mb-4">
                                    {{ __('Email Server Information') }}</h4>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Host Name') }}</label>
                                            <input class="form-control form-control-alternative" type="text"
                                                value="{{ old('host', $settings->host ?? '') }}" id="host" name="host">
                                            @error('host')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Port Number') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" value="{{ old('port', $settings->port ?? '') }}"
                                                placeholder="Common ports are 26, 465, 587" id="port" name="port">
                                            @error('port')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Username') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" value="{{ old('username', $settings->username ?? '') }}"
                                                id="username" name="username">
                                            @error('username')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Password') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" id="password" name="password"
                                                value="{{ old('password', $settings->password ?? '') }}">
                                            @error('password')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('From Address') }}</label>
                                            <input class="form-control form-control-alternative" type="email"
                                                value="{{ old('from_address', $settings->from_address ?? '') }}"
                                                id="from_address" name="from_address">
                                            @error('from_address')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Mail Encryption') }}</label>
                                            <select class="form-control form-control-alternative" name="encryption"
                                                id="encryption">
                                                <option disabled value=""> Select Encryption</option>
                                                <option value="null" <?php if (($settings->encryption ?? '') == 'null') {
    echo 'selected';
} ?>>Null - best for port 26</option>
                                                <option selected="" value="" <?php if (($settings->encryption ?? '') == '') {
    echo 'selected';
} ?>>None - best for port 587
                                                </option>
                                                <option value="ssl" <?php if (($settings->encryption ?? '') == 'ssl') {
    echo 'selected';
} ?>>SSL - best for port 465</option>
                                                <option value="tls" <?php if (($settings->encryption ?? '') == 'tls') {
    echo 'selected';
} ?>>TLS</option>
                                                <option value="starttls" <?php if (($settings->encryption ?? '') == 'starttls') {
    echo 'selected';
} ?>>STARTTLS</option>
                                            </select>
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
                        host: {
                            required: true,
                        },
                        port: {
                            required: true,
                            number: true
                        },
                        username: {
                            required: true
                        },
                        password: {
                            required: true
                        },
                        from_address: {
                            required: true,
                            email: true
                        }
                    }
                });
            });

        });
    </script>
@endpush
