@extends('layouts.app')
@section('administrator', 'active menu-open')
@section('company_branch', 'display: block')
@section('company_branch_manage', 'active')
@section('title')
    Company Branch Edit
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <style>
        .image {

            text-align: center;
            align-items: center;
        }

        .image img {
            border: 1px solid #dddddd;
            border-radius: 3px;
            padding: 2px;
            margin: 2px 0px;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Branch Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST"
                    action="{{ route('company_branch_edit', ['company_branch' => $company_branch]) }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">
                        <div class="col-md-7">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label class="col-sm-2 control-label"> Branch Name *</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter branch Name"
                                        name="name" value="{{ old('name', $company_branch->name) }}" required>

                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                <label class="col-sm-2 control-label">Mobile No. </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter Mobile No."
                                        name="mobile_no" value="{{ old('mobile_no', $company_branch->mobile_no) }}">

                                    @error('mobile_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label class="col-sm-2 control-label"> Email </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter email" name="email"
                                        value="{{ old('email', $company_branch->email) }}">

                                    @error('email')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label class="col-sm-2 control-label">Address </label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" placeholder="Enter Address" name="address"
                                        value="{{ old('address', $company_branch->address) }}">

                                    @error('address')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label class="col-sm-2 control-label">Status *</label>
                                <div class="col-sm-10">
                                    <div class="radio" style="display: inline">
                                        <label>
                                            <input type="radio" name="status" value="1"
                                                {{ old('status', $company_branch->status) == '1' ? 'checked' : '' }}>
                                            Active
                                        </label>
                                    </div>
                                    <div class="radio" style="display: inline">
                                        <label>
                                            <input type="radio" name="status" value="0"
                                                {{ old('status', $company_branch->status) == '0' ? 'checked' : '' }}>
                                            Inactive
                                        </label>
                                    </div>
                                    @error('status')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="feature_image"> Feature Image (Size: 800x400) </label>
                                <input type="file" name="image" id="image" class="">
                            </div>
                            <div class="image">
                                <img id="image_show"
                                    src="{{ $company_branch->image ? url($company_branch->image) : asset('img/no_slider.png') }}"
                                    height="200" width="400" alt="image">
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2();
        })

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#image_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#image").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
