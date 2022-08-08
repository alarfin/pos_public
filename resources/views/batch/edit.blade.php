@extends('layouts.app')
@section('batch', 'active menu-open')
@section('batch_manage', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Batch Information
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
        <form method="POST" action="{{ route('batch_edit', ['batch' => $batch->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Batch Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    {{-- <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('course_id') ? 'has-error' : '' }}">
                                            <label> Course <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="course_id" id="course_id" class="form-control select2">
                                                    <option value=""> Select course </option>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}"
                                                            @if (old('course_id', $batch->course_id) == $course->id) selected @endif>
                                                            {{ $course->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('course_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label> Batch name <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $batch->name) }}" autocomplete="off">
                                            </div>
                                            @error('name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('batch_no') ? 'has-error' : '' }}">
                                            <label> Batch no. </label>

                                            <div class="">
                                                <input type="text" class="form-control" id="batch_no" name="batch_no"
                                                    value="{{ old('batch_no', $batch->batch_no) }}" autocomplete="off">
                                            </div>
                                            @error('batch_no')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('seat') ? 'has-error' : '' }}">
                                            <label> Seat quantity </label>

                                            <div class="">
                                                <input type="number" class="form-control" id="seat" name="seat"
                                                    value="{{ old('seat', $batch->seat) }}" autocomplete="off">
                                            </div>
                                            @error('seat')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                            <label> Batch status <span class="text-danger">*</span></label>

                                            <div class="">
                                                <select name="status" id="status" class="form-control select2">
                                                    <option value="1"
                                                        @if (old('status', $batch->status) == 1) selected @endif> Active </option>
                                                    <option value="0"
                                                        @if (old('status', $batch->status) == 0) selected @endif> Inactive
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
