@extends('layouts.app')
@section('training_website', 'active menu-open')
@section('training_setting_manage', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <style>
        .logo {

            text-align: center;
            align-items: center;
        }

        .logo img {
            border: 1px solid #dddddd;
            border-radius: 3px;
            padding: 2px;
            margin: 2px 0px;
        }
    </style>
@endsection

@section('title')
    Setting Information
@endsection

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <form method="POST" action="{{ route('training_setting_add') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Us Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('company_name') ? 'has-error' : '' }}">
                                            <label> Company name <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control" id="company_name"
                                                    name="company_name"
                                                    value="{{ old('company_name', $training_setting->company_name ?? '') }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('company_name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label> Email </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $training_setting->email ?? '') }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('email')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                            <label> Mobile no </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                                    value="{{ old('mobile_no', $training_setting->mobile_no ?? '') }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('mobile_no')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label> Address </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ old('address', $training_setting->address ?? '') }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('address')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('google_map_embeded_code') ? 'has-error' : '' }}">
                                            <label> Google map (embeded code) </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="google_map_embeded_code"
                                                    name="google_map_embeded_code"
                                                    value="{{ old('google_map_embeded_code', $training_setting->google_map_embeded_code ?? '') }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('google_map_embeded_code')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('copyright_text') ? 'has-error' : '' }}">
                                            <label> Footer Copyright Text </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="copyright_text"
                                                    name="copyright_text"
                                                    value="{{ old('copyright_text', $training_setting->copyright_text ?? '') }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('copyright_text')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('logo') ? 'has-error' : '' }}">
                                    <label> Logo <small>(200x50)</small> </label>
                                    <div class="">
                                        <input type="file" class="form-control" id="logo" name="logo"
                                            value="{{ old('logo') }}" autocomplete="off">
                                    </div>
                                    <div class="logo">
                                        <img id="logo_show"
                                            src="@isset($training_setting->logo) {{ url($training_setting->logo) }} @else {{ asset('img/no_slider.png') }} @endisset"
                                            height="50" width="200" alt="logo">
                                    </div>
                                    @error('logo')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <!-- jQuery UI -->
    <script src="{{ asset('themes/backend/js/jquery-ui.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script src="{{ asset('themes/backend/bower_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('themes/backend/js/sweetalert2.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            CKEDITOR.replace('content');
        });

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#logo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#logo").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
