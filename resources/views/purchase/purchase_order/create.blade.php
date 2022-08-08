@extends('layouts.app')
@section('purchase', 'active menu-open')
@section('purchase_order_create', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{ asset('themes/backend/css/jquery-ui.css') }}" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Purchase Order
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Order Information
                    </h3>
                </div>
                <!-- form start -->
                <form method="POST" action="{{ route('purchase_order_create') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label> Select Branch *</label>
                                    <div class="">
                                        <select name="company_branch_id" id="company_branch_id"
                                            class="form-control select2">
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('company_branch_id') == $branch->id) selected @endif> {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('company_branch_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('supplier') ? 'has-error' : '' }}">
                                    <label>Supplier *</label>
                                    <select class="form-control supplier" name="supplier" id="supplier"
                                        data-placeholder="Select Supplier" required>
                                        <option value="">Select Supplier </option>
                                        @if (old('supplier'))
                                            <option value="{{ old('supplier') }}" selected>
                                                {{ App\Models\Supplier::find(old('supplier'))->name ?? '' }} </option>
                                        @endif
                                    </select>

                                    @error('supplier')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <label>Date *</label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="date" name="date"
                                            value="{{ empty(old('date')) ? ($errors->has('date') ? '' : date('Y-m-d')) : old('date') }}"
                                            autocomplete="off">
                                    </div>
                                    <!-- /.input group -->

                                    @error('date')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('invoice_no') ? 'has-error' : '' }}">
                                    <label> Invoice no *</label>

                                    <div class="">
                                        <input type="text" readonly class="form-control" id="invoice_no"
                                            name="invoice_no" value="{{ old('invoice_no', $invoice_no) }}"
                                            autocomplete="off">
                                    </div>
                                    <!-- /.input group -->

                                    @error('invoice_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                                    <label> Payment Method </label>

                                    <div class="">
                                        <select name="payment_method" id="payment_method" class="form-control select2">
                                            <option value="1" @if (old('payment_method') == 1) selected @endif> Cash
                                                In
                                                Hand </option>
                                            <option value="2" @if (old('payment_method') == 2) selected @endif> Bank
                                            </option>
                                        </select>
                                    </div>

                                    @error('payment_method')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3" id="bank_part" style="display: none;">
                                <div class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
                                    <label> Select Bank *</label>
                                    <div class="">
                                        <select name="bank_id" id="bank_id" class="form-control select2">
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    @if (old('bank_id') == $bank->id) selected @endif>
                                                    {{ $bank->account_no }} - {{ $bank->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('bank_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                                    <label> Note </label>

                                    <div class="">
                                        <input type="text" class="form-control" id="note" name="note"
                                            value="{{ old('note') }}" autocomplete="off">
                                    </div>
                                    <!-- /.input group -->

                                    @error('note')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">
                                        Enter the product code
                                        <span class="btn btn-xs btn-primary" id="product_add" style="margin-top: -10px">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </label>
                                    <input type="search" class="form-control product_code" id="product_code" name=""
                                        autofocus autocomplete="off">
                                </div>
                            </div>

                            {{-- <div class="col-md-3">
                                <div class="form-group {{ $errors->has('products') ? 'has-error' :'' }}">
                                    <label>Product *</label>
                                    <select class="form-control products" style="width: 100%;" name="products" id="products" data-placeholder="Select products" required>
                                        <option value="">Select products </option>
                                    </select>

                                    @error('products')
                                    <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> --}}
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> Code </th>
                                        <th width="20%"> Product </th>
                                        <th width="10%"> Stock </th>
                                        <th width="20%"> Serial no. </th>
                                        <th width="10%"> Quantity </th>
                                        <th width="10%">Unit Price</th>
                                        <th width="10%">Selling Price</th>
                                        <th>Total Cost</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody id="product-container">
                                    @if (old('product') != null && sizeof(old('product')) > 0)
                                        @foreach (old('product') as $item)
                                            <tr class="product-item">
                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('code.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" readonly class="form-control code"
                                                            name="code[]" value="{{ old('code.' . $loop->index) }}">
                                                        <input type="text" readonly
                                                            class="form-control company_branch_id"
                                                            name="company_branch_id[]"
                                                            value="{{ old('company_branch_id.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('product.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" readonly class="form-control product"
                                                            name="product[]"
                                                            value="{{ old('product.' . $loop->index) }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div
                                                        class="form-group readonly {{ $errors->has('stock.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" readonly class="form-control stock"
                                                            name="stock[]" value="{{ old('stock.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('serial_no.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control serial_no"
                                                            name="serial_no[]"
                                                            value="{{ old('buy_price.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('quantity.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="number" step="any"
                                                            class="form-control quantity" name="quantity[]"
                                                            value="{{ old('quantity.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('unit_price.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control unit_price"
                                                            name="unit_price[]"
                                                            value="{{ old('unit_price.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('selling_price.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control selling_price"
                                                            name="selling_price[]"
                                                            value="{{ old('selling_price.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td class="total-cost">0.00</td>
                                                <td class="text-center">
                                                    <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    @endif
                                </tbody>

                                <tfoot>
                                    <tr>
                                        {{-- <td>
                                            <a role="button" class="btn btn-info btn-sm" id="btn-add-product">Add Product</a>
                                        </td> --}}
                                        <th colspan="7" class="text-right">Product Amount</th>
                                        <th id="total-amount">0.00</th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Discount </th>
                                        <th>
                                            <input type="text" id="discount" name="discount"
                                                value="{{ old('discount') }}" placeholder="Amount or %"
                                                class="form-control" autocomplete="off">
                                            {{-- <small> Discount in amount as 100, Discount in percentage as 5%  </small> --}}
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Grand Total </th>
                                        <th>
                                            <input type="text" readonly id="grand_total" name="grand_total"
                                                value="{{ old('grand_total', 0) }}" class="form-control">
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Paid </th>
                                        <th>
                                            <input type="text" id="paid" name="paid"
                                                value="{{ old('paid', 0) }}" class="form-control">
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Due </th>
                                        <th>
                                            <input type="text" id="due" name="due"
                                                value="{{ old('due', 0) }}" class="form-control">
                                        </th>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
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

    <div class="modal fade" id="modal-product">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Product Information</h4>
                </div>
                <div class="modal-body">
                    <form id="product-form" enctype="multipart/form-data" name="product-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label class="control-label">Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                        value="{{ old('name') }}" required>

                                    @error('name')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                    <label class="control-label">Code <span class="text-danger">*</span></label>
                                    <input type="text" readonly class="form-control" placeholder="Enter Code"
                                        name="code" value="{{ old('code', $code) }}">

                                    @error('code')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
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
                                                @if (old('product_color_id') == $product_color->id) selected @endif>
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
                                                @if (old('product_size_id') == $product_size->id) selected @endif>
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
                                    <select name="product_category_id" id="product_category_id"
                                        class="form-control select2" required>
                                        <option value=""> Select Product Category </option>
                                        @foreach ($product_categories as $product_category)
                                            <option value="{{ $product_category->id }}"
                                                @if (old('product_category_id') == $product_category->id) selected @endif>
                                                {{ $product_category->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('product_category_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('product_brand_id') ? 'has-error' : '' }}">
                                    <label class="control-label"> Product Brand</label>
                                    <select name="product_brand_id" id="product_brand_id" class="form-control select2">
                                        <option value=""> Select Product Brand </option>
                                        @foreach ($product_brands as $product_brand)
                                            <option value="{{ $product_brand->id }}"
                                                @if (old('product_brand_id') == $product_brand->id) selected @endif>
                                                {{ $product_brand->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('product_brand_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('product_unit_id') ? 'has-error' : '' }}">
                                    <label class="control-label"> Product Unit <span class="text-danger">*</span>
                                    </label>
                                    <select name="product_unit_id" id="product_unit_id" class="form-control select2"
                                        required>
                                        <option value=""> Select Product Unit </option>
                                        @foreach ($product_units as $product_unit)
                                            <option value="{{ $product_unit->id }}"
                                                @if (old('product_unit_id') == $product_unit->id) selected @endif>
                                                {{ $product_unit->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('product_unit_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('buy_price') ? 'has-error' : '' }}">
                                    <label class="control-label"> Buy Price <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter buy_price"
                                        name="buy_price" value="{{ old('buy_price', 0) }}" required>

                                    @error('buy_price')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('sale_price') ? 'has-error' : '' }}">
                                    <label class="control-label"> Sale Price <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter sale price"
                                        name="sale_price" value="{{ old('sale_price', 0) }}" required>

                                    @error('sale_price')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('whole_sale_price') ? 'has-error' : '' }}">
                                    <label class="control-label"> Whole Sale Price <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter sale price"
                                        name="whole_sale_price" value="{{ old('whole_sale_price', 0) }}" required>

                                    @error('whole_sale_price')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('tax') ? 'has-error' : '' }}">
                                    <label class="control-label"> Tax (%) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter sale price"
                                        name="tax" value="{{ old('tax', 0) }}" required>

                                    @error('tax')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('vat') ? 'has-error' : '' }}">
                                    <label class="control-label"> VAT (%) <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="Enter sale price"
                                        name="vat" value="{{ old('vat', 0) }}" required>

                                    @error('vat')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('minimum_alert') ? 'has-error' : '' }}">
                                    <label class="control-label"> Alert quantity</label>
                                    <input type="text" class="form-control" placeholder="Enter alert quantity"
                                        name="minimum_alert" value="{{ old('minimum_alert', 0) }}">

                                    @error('minimum_alert')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('warranty') ? 'has-error' : '' }}">
                                    <label class="control-label">Warranty</label>
                                    <input type="text" class="form-control" placeholder="Enter warranty"
                                        name="warranty" value="{{ old('warranty') }}">

                                    @error('warranty')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('guarantee') ? 'has-error' : '' }}">
                                    <label class="control-label">Guarantee</label>
                                    <input type="text" class="form-control" placeholder="Enter guarantee"
                                        name="guarantee" value="{{ old('guarantee') }}">

                                    @error('guarantee')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label class="control-label">Description</label>
                                    <input type="text" class="form-control" placeholder="Enter Description"
                                        name="description" value="{{ old('description') }}">

                                    @error('description')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label class="control-label">Status <span class="text-danger">*</span> </label>
                                    <br>
                                    <div class="radio" style="display: inline">
                                        <label>
                                            <input type="radio" name="status" value="1"
                                                {{ old('status', 1) == '1' ? 'checked' : '' }}>
                                            Active
                                        </label>
                                    </div>

                                    <div class="radio" style="display: inline">
                                        <label>
                                            <input type="radio" name="status" value="0"
                                                {{ old('status') == '0' ? 'checked' : '' }}>
                                            Inactive
                                        </label>
                                    </div>

                                    @error('status')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" id="product_store"> Save </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <template id="template-product">
        <tr class="product-item">
            <td>
                <div class="form-group">
                    <input type="text" readonly class="form-control code" name="code[]">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" readonly class="form-control product" name="product[]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" readonly class="form-control stock" name="stock[]">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" class="form-control serial_no" name="serial_no[]">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="number" step="any" class="form-control quantity" name="quantity[]">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" class="form-control unit_price" name="unit_price[]">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" class="form-control selling_price" name="selling_price[]">
                </div>
            </td>

            <td class="total-cost">0.00</td>
            <td class="text-center">
                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
            </td>
        </tr>
    </template>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <!-- jQuery UI -->
    <script src="{{ asset('themes/backend/js/jquery-ui.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
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

            $('body').on('change', '#payment_method', function() {
                if ($(this).val() == 1) {
                    $('#bank_part').hide();
                } else {
                    $('#bank_part').show();
                }
            })
            $('#payment_method').trigger('change');

            $('.product_code').autocomplete({
                source: function(request, response) {
                    $.getJSON('{{ route('get_products_by_code') }}?term=' + request.term, function(
                        data) {
                        var array = $.map(data, function(row) {
                            return {
                                value: row.code,
                                label: row.code + ' - ' + row.name + ' - ' + row
                                    .product_color.name + ' - ' + row.product_size
                                    .name +
                                    ' (' + row
                                    .product_category.name + ')',
                            }
                        });

                        response($.ui.autocomplete.filter(array, request.term));
                    })
                },
                minLength: 3,
                delay: 500,
            });

            $('body').on('keypress', '.product_code', function(e) {
                if (e.keyCode == 13) {
                    var company_branch_id = $('#company_branch_id').val();
                    var code = $(this).val();
                    $this = $(this);
                    var serials = [];

                    $(".code").each(function(index) {
                        if ($(this).val() != '') {
                            serials.push($(this).val());
                        }
                    });

                    if ($.inArray(code, serials) != -1) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Already exist in list.',
                        });
                        return false;
                    }
                    if (code) {
                        $.ajax({
                            method: "GET",
                            url: "{{ route('get_product_details') }}",
                            data: {
                                code: code,
                                company_branch_id: company_branch_id
                            }
                        }).done(function(response) {
                            // console.log(response);
                            if (response.success) {
                                if (response.success) {
                                    var html = $('#template-product').html();
                                    var item = $(html);
                                    item.find('.code').val(response.data.code);
                                    item.find('.product').val(response.data.name);
                                    item.find('.stock').val(response.stock);
                                    item.find('.quantity').val(1);
                                    item.find('.unit_price').val(response.data.buy_price);
                                    item.find('.selling_price').val(response.data.sale_price);
                                    $('#product-container').append(item);

                                    $('.product_code').val('');
                                    // hide remove button
                                    if ($('.product-item').length <= 1) {
                                        $('.btn-remove').hide();
                                    } else {
                                        $('.btn-remove').show();
                                    }
                                    calculate();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'This product is not available',
                                    });
                                    calculate();
                                }
                            }
                        });
                    }
                    return false; // prevent the button click from happening
                }
            });


            $('body').on('click', '.btn-remove', function() {
                $(this).closest('.product-item').remove();
                calculate();

                if ($('.product-item').length <= 1) {
                    $('.btn-remove').hide();
                }

            });

            $('body').on('click', '#product_add', function() {
                $('#modal-product').modal('show');
            });
            $('body').on('click', '#product_store', function() {
                storeProduct();
            });

            function storeProduct() {
                var formData = new FormData($('#product-form')[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('store_new_product') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#modal-product').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            }).then((result) => {
                                // $('#table').DataTable().ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    }
                });
            }

            $('body').on('keyup', '#discount, #paid, .quantity, .unit_price', function() {
                calculate();
            });


            calculate();
        });

        function calculate() {
            var total = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = parseFloat($('.quantity:eq(' + i + ')').val() || 0);
                var unit_price = parseFloat($('.unit_price:eq(' + i + ')').val() || 0);

                $('.total-cost:eq(' + i + ')').html('' + (quantity * unit_price).toFixed(2));
                total += quantity * unit_price;
            });
            var discount = $('#discount').val();
            var isPercentage = discount[discount.length - 1];

            if (isPercentage == '%') {
                var percentage = parseFloat(discount.slice(0, -1));
                discount = (percentage * total) / 100;
            }
            discount = parseFloat(discount || 0);
            var paid = parseFloat($('#paid').val() || 0);
            var grand_total = parseFloat(total) - discount;
            var due = (grand_total - paid);
            $('#total-amount').html('' + total.toFixed(2));
            $('#grand_total').val(grand_total.toFixed(2));
            $('#due').val(due.toFixed(2));

        }

        $(document).ready(function() {
            $('#supplier').select2({
                placeholder: 'Select Supplier',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_supplier') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            })


        });
    </script>
@endsection
