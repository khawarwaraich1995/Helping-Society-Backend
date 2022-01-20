@extends('admin.layouts.app', ['title' => __('Business Setting')])

@section('content')
    @include('admin.layouts.partials.header', [
    'title' => __('Business Setting'),
    'class' => 'col-lg-12',
    ])
    <?php
        $submit_url = route('admin:update-business-settings');
    ?>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Business Settings Form') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="settings_form" method="post" action="{{ $submit_url }}" enctype="multipart/form-data">
                            @csrf
                            <fieldset>
                                <h4 class="heading-medium text-black font-weight-bold mb-4">
                                    {{ __('Business Information') }}</h4>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Business Name') }}</label>
                                            <input class="form-control form-control-alternative" type="text"
                                                value="{{ old('name', $b_settings->name ?? '') }}"
                                                placeholder="eg. Dt.Logics" id="name" name="name">
                                            @error('name')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Business Address') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" value="{{ old('address', $b_settings->address ?? '') }}"
                                                placeholder="eg. street abc" id="address" name="address">
                                            @error('address')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Bussiness Email') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="email" value="{{ old('email', $b_settings->email ?? '') }}"
                                                placeholder="example@abc.com" id="email" name="email">
                                            @error('email')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label"><span class="required-icon">*
                                                </span>{{ __('Business Phone') }}#</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" id="phone" name="phone" placeholder="+92123456789"
                                                value="{{ old('phone', $b_settings->phone ?? '') }}">
                                            @error('phone')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Emergency Phone') }}#</label>
                                            <input class="form-control form-control-alternative" type="text"
                                                value="{{ old('emergency_phone', $b_settings->emergency_phone ?? '') }}"
                                                placeholder="+92123456789" id="emergency_phone" name="emergency_phone">
                                            @error('emergency_phone')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <h3 class="heading-medium text-black font-weight-bold mb-3">
                                    {{ __('Business/Ride Settings') }}</h3>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Ride Cancellation Charges') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="number"
                                                step="0.01"
                                                value="{{ old('ride_cancellation_charges', $b_settings->ride_cancellation_charges ?? '') }}"
                                                placeholder="" id="ride_cancellation_charges"
                                                name="ride_cancellation_charges">
                                                <small class="text-muted">
                                                    <strong>{{__('Value should be in numeric/decimal form (eg. 10 or 14.32)')}}</strong>
                                                </small>
                                            @error('ride_cancellation_charges')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Ride Cancellation Time') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="number" id="ride_cancellation_time" name="ride_cancellation_time"
                                                step="0.01"
                                                placeholder=""
                                                value="{{ old('ride_cancellation_time', $b_settings->ride_cancellation_time ?? '') }}">
                                                <small class="text-muted">
                                                    <strong>{{__('Time should be in minutes (eg. 20)')}}</strong>
                                                </small>
                                            @error('ride_cancellation_time')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Distance Unit') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" id="distance_unit" name="distance_unit" placeholder=""
                                                value="{{ old('distance_unit', $b_settings->distance_unit ?? '') }}">
                                                <small class="text-muted">
                                                    <strong>{{__('Distance Unit should be in kilometers (eg. KM, Miles)')}}</strong>
                                                </small>
                                            @error('distance_unit')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Provider Search Radius') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="number" step="0.01" id="provider_search_radius" name="provider_search_radius"
                                                placeholder=""
                                                value="{{ old('provider_search_radius', $b_settings->provider_search_radius ?? '') }}">
                                                <small class="text-muted">
                                                    <strong>{{__('Radius should be in numeric/decimal form (eg. 10 or 14.32)')}}</strong>
                                                </small>
                                            @error('provider_search_radius')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Driver Acceptance time (Minutes)') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="number" id="driver_acceptance_time" name="driver_acceptance_time"
                                                value="{{ old('driver_acceptance_time', $b_settings->driver_acceptance_time ?? '') }}">
                                                <small class="text-muted">
                                                    <strong>{{__('Time should be in minutes (eg. 20)')}}</strong>
                                                </small>
                                            @error('driver_acceptance_time')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Admin Commission (%)') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="number" id="admin_comission" name="admin_comission" placeholder=""
                                                value="{{ old('admin_comission', $b_settings->admin_comission ?? '') }}">
                                                <small class="text-muted">
                                                    <strong>{{__('Commission should be in percentage (eg. 10)')}}</strong>
                                                </small>
                                            @error('admin_comission')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <h3 class="heading-medium text-black font-weight-bold mb-3">{{ __('General Setting') }}
                                </h3>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Date Time Format') }}</label>
                                                <select class="form-control form-control-alternative" name="date_time_format">
                                                    <option value="">{{__('Select Date Format')}}</option>
                                                    <option value="Y-m-d "> {{ __('YYYY-MM-DD') }}</option>
                                                    <option value="Y-d-m"> {{ __('YYYY-DD-MM') }}</option>
                                                    <option value="d-m-Y"> {{ __('DD-MM-YYYY') }}</option>
                                                    <option value="m-d-Y"> {{ __('MM-DD-YYYY') }}</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Time Format') }}</label>
                                                <select class="form-control form-control-alternative" name="time_format">
                                                    <option value="">{{__('Select Time Format')}}</option>
                                                    <option value="h:i:s a"> {{ __('12-Hour (12:15 AM)') }}</option>
                                                    <option value="h:i:s"> {{ __('24-Hour (00:15)') }}</option>
                                                </select>
                                        </div>
                                    </div>
                                    @php
                                        $timezone_list = Timezonelist::toArray();
                                       // dd($timezone_list);
                                    @endphp
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Timezone') }}</label>
                                            @isset($timezone_list)
                                                <select class="form-control form-control-alternative" name="timezone">
                                                    @foreach ($timezone_list as $key => $list)
                                                        <optgroup label="{{ $key }}">
                                                            @foreach ($list as $key => $zone)
                                                                @php
                                                                    $from   = ["&nbsp;&nbsp;&nbsp;&nbsp;", "&plus;", "&minus;"];
                                                                    $to   = [" ", "+", "-"];
                                                                @endphp
                                                                <option value="{{ $key }}" <?php if ($key == ($b_settings->timezone ?? '')) { echo 'selected'; } ?>>{{ str_replace($from,$to,$zone); }}
                                                                </option>
                                                            @endforeach

                                                        </optgroup>

                                                    @endforeach

                                                </select>
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Currency') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" id="currency" name="currency" placeholder="eg. $"
                                                value="{{ old('currency', $b_settings->currency ?? '') }}">
                                            @error('currency')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Footer Text') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="text" id="footer_text" name="footer_text" placeholder=""
                                                value="{{ old('footer_text', $b_settings->footer_text ?? '') }}">
                                            @error('footer_text')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <h3 class="heading-medium text-black font-weight-bold mb-3">{{ __('Social Links') }}
                                </h3>
                                <hr>
                                <div class="row mt-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Facebook Link') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="url" value="{{ old('fb_link', $b_settings->fb_link ?? '') }}"
                                                placeholder="" id="fb_link" name="fb_link">
                                            @error('fb_link')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label">{{ __('Instagram Link') }}</label>
                                            <input class="form-control form-control-alternative" autocomplete="off"
                                                type="url" id="insta_link" name="insta_link" placeholder=""
                                                value="{{ old('insta_link', $b_settings->insta_link ?? '') }}">
                                            @error('insta_link')
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
                $("#settings_form").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        email: {
                            email: true
                        },
                        phone: {
                            required: true
                        },
                        emergency_phone: {
                            required: true
                        },
                        ride_cancellation_charges: {
                            number: true
                        },
                        ride_cancellation_time: {
                            number: true
                        },
                        admin_comission: {
                            number: true
                        }
                    }
                });
            });

        });
    </script>
@endpush
