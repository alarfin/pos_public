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
                <form class="" method="POST" action="{{ route('product_edit', ['product' => $product->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label class="control-label">Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                        value="{{ old('name', $product->name) }}" required>

                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                    <label class="control-label">Code <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <input type="text" readonly class="form-control" placeholder="Enter Code"
                                            name="code" value="{{ old('code', $product->code) }}">

                                        @error('code')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('product_color_id') ? 'has-error' : '' }}">
                                    <label class="control-label"> Product Color <span class="text-danger">*</span>
                                    </label>
                                    <select name="product_color_id" id="product_color_id" class="form-control select2"
                                        required>
                                        {{-- <option value=""> Select Product color </option> --}}
                                        @foreach ($product_colors as $product_color)
                                            <option value="{{ $product_color->id }}"
                                                @if (old('product_color_id', $product->product_color_id) == $product_color->id) selected @endif>
                                                {{ $product_color->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('product_color_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('product_size_id') ? 'has-error' : '' }}">
                                    <label class="control-label"> Product Size <span class="text-danger">*</span>
                                    </label>
                                    <select name="product_size_id" id="product_size_id" class="form-control select2"
                                        required>
                                        {{-- <option value=""> Select Product Size </option> --}}
                                        @foreach ($product_sizes as $product_size)
                                            <option value="{{ $product_size->id }}"
                                                @if (old('product_size_id', $product->product_size_id) == $product_size->id) selected @endif>
                                                {{ $product_size->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('product_size_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('product_category_id') ? 'has-error' : '' }}">
                                    <label class="control-label"> Product Category <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <select name="product_category_id" id="product_category_id"
                                            class="form-control select2" required>
                                            <option value=""> Select Product Category </option>
                                            @foreach ($product_categories as $product_category)
                                                <option value="{{ $product_category->id }}"
                                                    @if (old('product_category_id', $product->product_category_id) == $product_category->id) selected @endif>
                                                    {{ $product_category->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('product_category_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('product_brand_id') ? 'has-error' : '' }}">
                                    <label class="control-label"> Product Brand </label>

                                    <div class="">
                                        <select name="product_brand_id" id="product_brand_id" class="form-control select2">
                                            <option value=""> Select Product Brand </option>
                                            @foreach ($product_brands as $product_brand)
                                                <option value="{{ $product_brand->id }}"
                                                    @if (old('product_brand_id', $product->product_brand_id) == $product_brand->id) selected @endif>
                                                    {{ $product_brand->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('product_brand_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('product_unit_id') ? 'has-error' : '' }}">
                                    <label class="control-label"> Product Unit <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <select name="product_unit_id" id="product_unit_id" class="form-control select2"
                                            required>
                                            <option value=""> Select Product Unit </option>
                                            @foreach ($product_units as $product_unit)
                                                <option value="{{ $product_unit->id }}"
                                                    @if (old('product_unit_id', $product->product_unit_id) == $product_unit->id) selected @endif>
                                                    {{ $product_unit->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('product_unit_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('buy_price') ? 'has-error' : '' }}">
                                    <label class="control-label"> Buy Price <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter buy_price"
                                            name="buy_price" value="{{ old('buy_price', $product->buy_price) }}" required>

                                        @error('buy_price')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : '' }}">
                                    <label class="control-label"> Sale Price <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter sale price"
                                            name="sale_price" value="{{ old('sale_price', $product->sale_price) }}"
                                            required>

                                        @error('sale_price')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('whole_sale_price') ? 'has-error' : '' }}">
                                    <label class="control-label"> Whole Sale Price <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter sale price"
                                            name="whole_sale_price"
                                            value="{{ old('whole_sale_price', $product->whole_sale_price) }}" required>

                                        @error('whole_sale_price')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('tax') ? 'has-error' : '' }}">
                                    <label class="control-label"> Tax (%) <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter sale price"
                                            name="tax" value="{{ old('tax', $product->tax) }}" required>

                                        @error('tax')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                                    <label class="control-label"> VAT (%) <span class="text-danger">*</span>
                                    </label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter sale price"
                                            name="vat" value="{{ old('vat', $product->vat) }}" required>

                                        @error('vat')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('minimum_alert') ? 'has-error' : '' }}">
                                    <label class="control-label"> Alert quantity</label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter alert quantity"
                                            name="minimum_alert"
                                            value="{{ old('minimum_alert', $product->minimum_alert) }}">

                                        @error('minimum_alert')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('warranty') ? 'has-error' : '' }}">
                                    <label class="control-label">Warranty</label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter warranty"
                                            name="warranty" value="{{ old('warranty', $product->warranty) }}">

                                        @error('warranty')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('guarantee') ? 'has-error' : '' }}">
                                    <label class="control-label">Guarantee</label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter guarantee"
                                            name="guarantee" value="{{ old('guarantee', $product->guarantee) }}">

                                        @error('guarantee')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label class="control-label">Description</label>

                                    <div class="">
                                        <input type="text" class="form-control" placeholder="Enter Description"
                                            name="description" value="{{ old('description', $product->description) }}">

                                        @error('description')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label class="control-label">Status *</label> <br>

                                    <div class="">

                                        <div class="radio" style="display: inline">
                                            <label>
                                                <input type="radio" name="status" value="1"
                                                    {{ old('status', $product->status) == '1' ? 'checked' : '' }}>
                                                Active
                                            </label>
                                        </div>

                                        <div class="radio" style="display: inline">
                                            <label>
                                                <input type="radio" name="status" value="0"
                                                    {{ old('status', $product->status) == '0' ? 'checked' : '' }}>
                                                Inactive
                                            </label>
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
