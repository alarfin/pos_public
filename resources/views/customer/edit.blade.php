@extends('layouts.app')
@section('customer', 'active menu-open')
@section('customer_manage', 'active')
@section('title')
    Customer Edit
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Customer Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST"
                    action="{{ route('customer_edit', ['customer' => $customer->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Customer Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Customer Name" name="name"
                                    value="{{ old('name', $customer->name) }}">

                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Mobile No. <span class="text-danger">*</span> </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Mobile No." name="mobile_no"
                                    value="{{ old('mobile_no', $customer->mobile_no) }}" required>

                                @error('mobile_no')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label"> Email </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter email" name="email"
                                    value="{{ old('email', $customer->email) }}">

                                @error('email')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Address </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Address" name="address"
                                    value="{{ old('address', $customer->address) }}">

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
                                            {{ old('status', $customer->status) == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>
                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0"
                                            {{ old('status', $customer->status) == '0' ? 'checked' : '' }}>
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
