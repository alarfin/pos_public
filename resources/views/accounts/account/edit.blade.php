@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('account', 'display: block')
@section('account_manage', 'active')
@section('title')
    Account Edit
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Account Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('account_edit', ['account'=>$account->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('account_head_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Account head *</label>

                            <div class="col-sm-10">
                                <select class="form-control select2" name="account_head_id" id="account_head_id">
                                    <option value="">Select account head </option>
                                    @foreach ($account_classes as $account_class)
                                        <optgroup label="{{ $account_class->name }}">
                                            @foreach ($account_class->accountHeads??[] as $account_head)
                                                <option value="{{ $account_head->id }}" @if (old('account_id', $account->account_head_id)==$account_head->id) selected @endif> - {{ $account_head->name }} </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>

                                @error('type')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name', $account->name) }}">

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
                                        <input type="radio" name="status" value="1" {{ old('status', $account->status) == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ old('status', $account->status) == '0' ? 'checked' : '' }}>
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
