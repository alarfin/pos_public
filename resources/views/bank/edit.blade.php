@extends('layouts.app')
@section('bank', 'active menu-open')
@section('bank_manage', 'active')
@section('title')
    Bank Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Bank Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('bank_edit', ['bank' => $bank->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Bank Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                    value="{{ old('name', $bank->name) }}">

                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('account_name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Account Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Account Name"
                                    name="account_name" value="{{ old('account_name', $bank->account_name) }}">

                                @error('account_name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('account_no') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Account No. *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Account No." name="account_no"
                                    value="{{ old('account_no', $bank->account_no) }}">

                                @error('account_no')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('account_code') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Account Code</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Code" name="account_code"
                                    value="{{ old('account_code', $bank->account_code) }}">

                                @error('account_code')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('branch') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label"> Branch </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter branch name" name="branch"
                                    value="{{ old('branch', $bank->branch) }}">

                                @error('branch')
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
                                            {{ empty(old('status'))
                                                ? ($errors->has('status')
                                                    ? ''
                                                    : ($bank->status == '1'
                                                        ? 'checked'
                                                        : ''))
                                                : (old('status') == '1'
                                                    ? 'checked'
                                                    : '') }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0"
                                            {{ empty(old('status'))
                                                ? ($errors->has('status')
                                                    ? ''
                                                    : ($bank->status == '0'
                                                        ? 'checked'
                                                        : ''))
                                                : (old('status') == '0'
                                                    ? 'checked'
                                                    : '') }}>
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
