@extends('layouts.app')
@section('product', 'active menu-open')
@section('product_manage', 'active')

@section('title')
    Product Manage 
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('product_edit', ['product'=>$product->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name', $product->name) }}">

                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('code') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Code *</label>

                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control" placeholder="Enter Code"
                                       name="code" value="{{ old('code', $product->code) }}">

                                @error('code')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('product_category_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Product Category</label>

                            <div class="col-sm-10">
                                <select name="product_category_id" id="product_category_id" class="form-control select2">
                                    <option value=""> Select Product Category </option>
                                    @foreach ($product_categories as $product_category)
                                        <option value="{{$product_category->id}}" @if (old('product_category_id', $product->product_category_id)==$product_category->id) selected @endif>{{ $product_category->name }}</option>
                                    @endforeach
                                </select>

                                @error('product_category_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('product_unit_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Product Unit </label>

                            <div class="col-sm-10">
                                <select name="product_unit_id" id="product_unit_id" class="form-control select2">
                                    <option value=""> Select Product Unit </option>
                                    @foreach ($product_units as $product_unit)
                                        <option value="{{$product_unit->id}}" @if (old('product_unit_id', $product->product_unit_id)==$product_unit->id) selected @endif>{{ $product_unit->name }}</option>
                                    @endforeach
                                </select>

                                @error('product_unit_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('buy_price') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Buy Price</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter buy_price"
                                       name="buy_price" value="{{ old('buy_price', $product->buy_price) }}">

                                @error('buy_price')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('sale_price') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Sale Price</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter sale price"
                                       name="sale_price" value="{{ old('sale_price', $product->sale_price) }}">

                                @error('sale_price')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('whole_sale_price') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Whole Sale Price</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter sale price"
                                       name="whole_sale_price" value="{{ old('whole_sale_price', $product->whole_sale_price) }}">

                                @error('whole_sale_price')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('tax') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Tax (%)</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter sale price"
                                       name="tax" value="{{ old('tax', $product->tax) }}">

                                @error('tax')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('vat') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> VAT (%)</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter sale price"
                                       name="vat" value="{{ old('vat', $product->vat) }}">

                                @error('vat')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('description') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Description</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Description"
                                       name="description" value="{{ old('description', $product->description) }}">

                                @error('description')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Status *</label>

                            <div class="col-sm-10">

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="1" {{ old('status', $product->status) == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ old('status', $product->status) == '0' ? 'checked' : '' }}>
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
    $(function () {
        $('.select2').select2();
    })
</script>
@endsection