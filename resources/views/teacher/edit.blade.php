@extends('layouts.app')
@section('teacher', 'active menu-open')
@section('teacher_manage', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <style>
        .photo {

            text-align: center;
            align-items: center;
        }

        .photo img {
            border: 1px solid #dddddd;
            border-radius: 3px;
            padding: 2px;
            margin: 2px 0px;
            width: 150px;
            height: 150px;
        }
    </style>
@endsection

@section('title')
    Teacher Edit
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <form method="POST" action="{{ route('teacher_edit', ['teacher' => $teacher->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Teacher Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                            <label> Company branch <span class="text-danger">*</span> </label>
                                            <div class="">
                                                <select name="company_branch_id" id="company_branch_id"
                                                    class="form-control select2" required>
                                                    @foreach ($company_branches as $company_branche)
                                                        <option value="{{ $company_branche->id }}"
                                                            @if (old('company_branch_id', $teacher->company_branch_id) == $company_branche->id) selected @endif>
                                                            {{ $company_branche->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('company_branch_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('designation_id') ? 'has-error' : '' }}">
                                            <label> Designation <span class="text-danger">*</span> </label>
                                            <div class="">
                                                <select name="designation_id" id="designation_id"
                                                    class="form-control select2" required>
                                                    @foreach ($designations as $designation)
                                                        <option value="{{ $designation->id }}"
                                                            @if (old('designation_id', $teacher->designation_id) == $designation->id) selected @endif>
                                                            {{ $designation->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('designation_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label> Teacher name <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $teacher->name) }}" autocomplete="off">
                                            </div>
                                            @error('name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                            <label> Mobile no. </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                                    value="{{ old('mobile_no', $teacher->mobile_no) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('mobile_no')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('education') ? 'has-error' : '' }}">
                                            <label> Education </label>

                                            <div class="">
                                                <input type="text" class="form-control" id="education" name="education"
                                                    value="{{ old('education', $teacher->education) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('education')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label> Address </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ old('address', $teacher->address) }}" autocomplete="off">
                                            </div>
                                            @error('address')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('short_bio') ? 'has-error' : '' }}">
                                            <label> Short Bio </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="short_bio" name="short_bio"
                                                    value="{{ old('short_bio', $teacher->short_bio) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('short_bio')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                    <label> Photo </label>
                                    <div class="">
                                        <input type="file" class="form-control" id="photo" name="photo"
                                            autocomplete="off">
                                    </div>
                                    <div class="photo">
                                        <img id="photo_show"
                                            src="{{ $teacher->photo ? url($teacher->photo) : asset('img/no_image.png') }}"
                                            alt="photo">
                                    </div>
                                    @error('photo')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                    <label> Gender <span class="text-danger">*</span> </label>
                                    <div class="">
                                        <select name="gender" id="gender" class="form-control select2">
                                            <option value="Male" @if (old('gender', $teacher->gender) == 'Male') selected @endif> Male
                                            </option>
                                            <option value="Female" @if (old('gender', $teacher->gender) == 'Female') selected @endif>
                                                Female </option>
                                            <option value="Others" @if (old('gender', $teacher->gender) == 'Others') selected @endif>
                                                Others </option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label> Status <span class="text-danger">*</span></label>

                                    <div class="">
                                        <select name="status" id="status" class="form-control select2">
                                            <option value="1" @if (old('status', $teacher->status) == 1) selected @endif>
                                                Active </option>
                                            <option value="0" @if (old('status', $teacher->status) == 0) selected @endif>
                                                In-active
                                            </option>
                                        </select>
                                    </div>
                                    @error('status')
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
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
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

            // CKEDITOR.replace('description');
        });

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#photo").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
