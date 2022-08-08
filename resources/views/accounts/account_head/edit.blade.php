@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('account_head', 'display: block')
@section('account_head_manage', 'active')

@section('title')
    Account Head Edit
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Account Head Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('account_head_edit', ['account_head'=>$account_head->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('account_class_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Account Class *</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" name="account_class_id">
                                    <option value="">Select account class </option>
                                    @foreach ($account_classes as $account_class)
                                        <option value="{{$account_class->id}}" @if (old('account_class_id', $account_head->account_class_id)==$account_class->id) selected @endif> {{$account_class->name}} </option>
                                    @endforeach
                                </select>

                                @error('account_class_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name', $account_head->name) }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Status *</label>

                            <div class="col-sm-10">

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="1" {{ old('status', $account_head->status) == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ old('status', $account_head->status) == '0' ? 'checked' : '' }}>
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
        $(function(){
            $('.select2').select2();
        })
    </script>
@endsection