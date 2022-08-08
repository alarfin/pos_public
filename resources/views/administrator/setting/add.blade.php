@extends('layouts.app')
@section('administrator', 'active menu-open')
@section('setting_add', 'active')
@section('title')
    Setting
 @endsection
 @section('style')
    <style>
        .logo{
            padding: 5px;
        }
    </style>
 @endsection

@section('content')
    @if(session('success'))
	  <div class="alert alert-success alert-dismissable">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		  {{session('success')}}
	  </div>
	@endif
	@if($errors->any())
		  @foreach($errors->all() as $error)
			<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{$error}}
			</div>
		@endforeach
	@endif
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"> Setting Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('setting_add') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                                    <label class="col-sm-2 control-label">Name </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Enter company name"
                                            name="name" value="{{ old('name', $setting->name??'') }}">

                                        @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                                    <label class="col-sm-2 control-label">Email </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Enter company email"
                                            name="email" value="{{ old('email', $setting->email??'') }}">

                                        @error('email')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' :'' }}">
                                    <label class="col-sm-2 control-label"> Mobile no </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Enter company mobile no"
                                            name="mobile_no" value="{{ old('mobile_no', $setting->mobile_no??'') }}">

                                        @error('mobile_no')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('address') ? 'has-error' :'' }}">
                                    <label class="col-sm-2 control-label">Address </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" placeholder="Enter Address"
                                            name="address" value="{{ old('address', $setting->address??'') }}">

                                        @error('address')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('logo') ? 'has-error' :'' }}">
                                    <label class="col-sm-2 control-label"> Logo </label>

                                    <div class="col-sm-10">
                                        @if ($setting && $setting->logo)
                                            <div class="logo">
                                                <img src="{{ url('storage/app/'.$setting->logo) }}" height="50" alt="">
                                            </div>
                                        @endif
                                        <input type="file" class="form-control"
                                            name="logo" value="{{ old('logo', $setting->logo??'') }}">

                                        @error('logo')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
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
