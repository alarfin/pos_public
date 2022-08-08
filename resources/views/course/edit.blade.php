@extends('layouts.app')
@section('course', 'active menu-open')
@section('course_manage', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

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
            width: 200px;
            height: 150px;
        }
    </style>
@endsection

@section('title')
    Course Information
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
        <form method="POST" action="{{ route('course_edit', ['course' => $course->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Course Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label> Course name <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $course->name) }}" autocomplete="off">
                                            </div>
                                            @error('name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('teacher_id') ? 'has-error' : '' }}">
                                            <label> Teacher </label>
                                            <div class="">
                                                <select name="teacher_id" id="teacher_id" class="form-control select2">
                                                    <option value=""> Select teacher </option>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}"
                                                            @if (old('teacher_id', $course->teacher_id) == $teacher->id) selected @endif>
                                                            {{ $teacher->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('teacher_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div
                                            class="form-group {{ $errors->has('course_category_id') ? 'has-error' : '' }}">
                                            <label> Select category <span class="text-danger">*</span> </label>
                                            <div class="">
                                                <select name="course_category_id" id="course_category_id"
                                                    class="form-control select2">
                                                    @foreach ($course_categories as $course_category)
                                                        <option value="{{ $course_category->id }}"
                                                            @if (old('course_category_id', $course->course_category_id) == $course_category->id) selected @endif>
                                                            {{ $course_category->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('course_category_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('duration') ? 'has-error' : '' }}">
                                            <label> Course duration <span class="text-danger">*</span></label>

                                            <div class="">
                                                <input type="text" class="form-control" id="duration" name="duration"
                                                    value="{{ old('duration', $course->duration) }}" autocomplete="off">
                                            </div>
                                            @error('duration')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('fee') ? 'has-error' : '' }}">
                                            <label> Course fee <span class="text-danger">*</span></label>

                                            <div class="">
                                                <input type="text" class="form-control" id="fee" name="fee"
                                                    value="{{ old('fee', $course->fee) }}" autocomplete="off">
                                            </div>
                                            @error('fee')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label> Course status <span class="text-danger">*</span></label>

                                            <div class="">
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value="1"
                                                        @if (old('status', $course->status) == 1) selected @endif> Active </option>
                                                    <option value="0"
                                                        @if (old('status', $course->status) == 0) selected @endif> In-active
                                                    </option>
                                                </select>
                                            </div>
                                            @error('status')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('short_description') ? 'has-error' : '' }}">
                                            <label> Course short description <span class="text-danger">*</span></label>

                                            <div class="">
                                                <input type="text" class="form-control" id="short_description"
                                                    name="short_description"
                                                    value="{{ old('short_description', $course->short_description) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('short_description')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                    <label> Feature image </label>
                                    <div class="">
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="{{ old('image') }}" autocomplete="off">
                                    </div>
                                    <div class="image">
                                        <img id="image_show"
                                            src="{{ $course->image ? url($course->image) : asset('img/no_image.png') }}"
                                            alt="Image">
                                    </div>
                                    @error('image')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label> Description </label>

                                    <div class="">
                                        <textarea name="description" id="description" class="form-control">{!! old('description', $course->description) !!}</textarea>
                                    </div>
                                    @error('description')
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

            CKEDITOR.replace('description');
        });

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
