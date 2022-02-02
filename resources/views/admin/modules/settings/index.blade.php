@extends('admin.layouts.app', ['title' => __('Settings')])

@section('content')
    @include('admin.layouts.partials.header', [
    'title' => __('Site Settings'),
    'class' => 'col-lg-12',
    ])
    <?php
        $submit_url = route('admin:update-settings');
    ?>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="col-12 mb-0">{{ __('Settings Form') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="settings_form" method="post" action="{{ $submit_url }}" enctype="multipart/form-data">
                            @csrf
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
