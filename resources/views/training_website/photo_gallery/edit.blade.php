@extends('layouts.app')
@section('training_website', 'active menu-open')
@section('training_photo_gallery_manage', 'active')

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
        }
    </style>
@endsection

@section('title')
    Photo Gallery Information
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
        <form method="POST"
            action="{{ route('training_photo_gallery_edit', ['training_photo_gallery' => $training_photo_gallery->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Photo Gallery Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label> name <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $training_photo_gallery->name) }}"
                                                    autocomplete="off" required>
                                            </div>
                                            @error('name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('sort') ? 'has-error' : '' }}">
                                            <label> Sorting no. <span class="text-danger">*</span> </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="sort" name="sort"
                                                    value="{{ old('sort', $training_photo_gallery->sort) }}"
                                                    autocomplete="off" required>
                                            </div>
                                            @error('sort')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label> Status <span class="text-danger">*</span></label>

                                            <div class="">
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value="1"
                                                        @if (old('status', $training_photo_gallery->status) == 1) selected @endif>
                                                        Active </option>
                                                    <option value="0"
                                                        @if (old('status', $training_photo_gallery->status) == 0) selected @endif>
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                    <label> Image <small>(800x500)</small> </label>
                                    <div class="">
                                        <input type="file" class="form-control" id="image" name="image"
                                            value="{{ old('image') }}" autocomplete="off">
                                    </div>
                                    <div class="image">
                                        <img id="image_show"
                                            src="{{ $training_photo_gallery->image ? url($training_photo_gallery->image) : asset('img/no_slider.png') }}"
                                            height="250" width="400" alt="image">
                                    </div>
                                    @error('image')
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
