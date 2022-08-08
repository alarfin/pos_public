@extends('layouts.app')
@section('photocopy_machine', 'active menu-open')
@section('photocopy_machine_manage', 'active')

@section('title')
    Photocopy Machine Edit
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Photocopy Machine Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST"
                    action="{{ route('photocopy_machine_edit', ['photocopy_machine' => $photocopy_machine->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label"> Branch <span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select name="company_branch_id" id="company_branch_id" class="form-control select2"
                                    required>
                                    {{-- <option value=""> Select branch </option> --}}
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"
                                            @if (old('company_branch_id', $photocopy_machine->company_branch_id) == $branch->id) selected @endif>
                                            {{ $branch->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('company_branch_id')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                    value="{{ old('name', $photocopy_machine->name) }}">

                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label"> Description </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter description"
                                    name="description" value="{{ old('description', $photocopy_machine->description) }}">

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
                                            {{ old('status', $photocopy_machine->status) == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0"
                                            {{ old('status', $photocopy_machine->status) == '0' ? 'checked' : '' }}>
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
