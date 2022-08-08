@extends('layouts.app')
@section('course_category', 'active menu-open')
@section('course_category_manage', 'active')

@section('title')
    Course Category Edit
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Course Category Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST"
                    action="{{ route('course_category_edit', ['course_category' => $course_category->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                    value="{{ old('name', $course_category->name) }}">

                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Description </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter description"
                                    name="description" value="{{ old('description', $course_category->description) }}">

                                @error('description')
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
                                            {{ old('status', $course_category->status) == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0"
                                            {{ old('status', $course_category->status) == '0' ? 'checked' : '' }}>
                                        Inactive
                                    </label>
                                </div>

                                @error('status')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
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
    </script>
@endsection
