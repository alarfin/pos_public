@extends('layouts.app')
@section('sale', 'active menu-open')
@section('sale_order_manage', 'active')

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
    Sale Order Edit
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Order Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('sale_order_edit', ['sale_order' => $sale_order->id]) }}">
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
                                                    @if (old('company_branch_id', $sale_order->company_branch_id) == $branch->id) selected @endif> {{ $branch->name }}
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
                                <div class="form-group {{ $errors->has('customer') ? 'has-error' : '' }}">
                                    <label> Customer <span class="text-danger">*</span> &nbsp;&nbsp;
                                        <span class="btn-xs btn-primary" id="customer_add" style="margin-top: -10px">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </label>
                                    <select class="form-control customer" name="customer" id="customer"
                                        data-placeholder="Select customer" required>
                                        <option value=""> Select customer </option>
                                        @if (old('customer', $sale_order->customer_id))
                                            <option value="{{ old('customer', $sale_order->customer_id) }}" selected>
                                                @php
                                                    $customer = App\Models\Customer::find(old('customer', $sale_order->customer_id));
                                                @endphp
                                                {{ $customer->mobile_no ?? '' }} - {{ $customer->name ?? '' }}
                                            </option>
                                        @endif
                                    </select>

                                    @error('customer')
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
                                            value="{{ empty(old('date')) ? ($errors->has('date') ? '' : date('Y-m-d')) : old('date', $sale_order->date) }}"
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
                                            name="invoice_no" value="{{ old('invoice_no', $sale_order->invoice_no) }}"
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
                                            <option value="1" @if (old('payment_method', $sale_order->payment_method) == 1) selected @endif> Cash
                                                In
                                                Hand </option>
                                            <option value="2" @if (old('payment_method', $sale_order->payment_method) == 2) selected @endif> Bank
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
                                                    @if (old('bank_id', $sale_order->bank_id) == $bank->id) selected @endif>
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
                                            value="{{ old('note', $sale_order->note) }}" autocomplete="off">
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
                                    <label for=""> Enter the product code </label>
                                    <input type="search" class="form-control product_code" id="product_code"
                                        name="" autofocus autocomplete="off">
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
                                        <th width="20%">Serial</th>
                                        <th width="10%"> Quantity </th>
                                        <th width="10%">Unit Price</th>
                                        <th width="10%"> Discount </th>
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
                                                        <input type="hidden" readonly
                                                            class="form-control company_branch_ids"
                                                            name="company_branch_ids[]"
                                                            value="{{ old('company_branch_ids.' . $loop->index) }}">
                                                        <input type="hidden" class="form-control buy_price"
                                                            name="buy_price[]"
                                                            value="{{ old('buy_price.' . $loop->index) }}">
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
                                                        class="form-group {{ $errors->has('product_discount.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control product_discount"
                                                            name="product_discount[]"
                                                            value="{{ old('product_discount.' . $loop->index) }}">
                                                        <input type="hidden" class="form-control product_tax"
                                                            name="product_tax[]"
                                                            value="{{ old('product_tax.' . $loop->index) }}">
                                                        <input type="hidden" class="form-control product_vat"
                                                            name="product_vat[]"
                                                            value="{{ old('product_vat.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td class="total-cost">0.00</td>
                                                <td class="text-center">
                                                    <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        @foreach ($sale_order->products as $sale_order_product)
                                            <tr class="product-item">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control bg-blue code"
                                                            name="code[]" value="{{ $sale_order_product->code }}">
                                                        <input type="hidden" readonly
                                                            class="form-control company_branch_ids"
                                                            name="company_branch_ids[]"
                                                            value="{{ $sale_order_product->company_branch_id }}">
                                                        <input type="hidden" class="form-control buy_price"
                                                            name="buy_price[]"
                                                            value="{{ $sale_order_product->buy_price }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control product"
                                                            name="product[]" value="{{ $sale_order_product->name }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control stock"
                                                            name="stcok[]">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control serial_no"
                                                            name="serial_no[]"
                                                            value="{{ $sale_order_product->serial_no }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any"
                                                            class="form-control quantity" name="quantity[]"
                                                            value="{{ $sale_order_product->quantity }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control unit_price"
                                                            name="unit_price[]"
                                                            value="{{ $sale_order_product->unit_price }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control product_discount"
                                                            name="product_discount[]" placeholder="Amount or %"
                                                            value="{{ $sale_order_product->product_discount }}">
                                                        <input type="hidden" class="form-control product_tax"
                                                            name="product_tax[]"
                                                            value="{{ $sale_order_product->tax_percentage }}">
                                                        <input type="hidden" class="form-control product_vat"
                                                            name="product_vat[]"
                                                            value="{{ $sale_order_product->vat_percentage }}">
                                                    </div>
                                                </td>

                                                <td class="total-cost">0.00</td>
                                                <td class="text-center">
                                                    <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                                </td>
                                            </tr>
                                        @endforeach
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
                                                value="{{ old('discount', $sale_order->discount) }}"
                                                placeholder="Amount or %" class="form-control" autocomplete="off">
                                            {{-- <small> Discount in amount as 100, Discount in percentage as 5%  </small> --}}
                                        </th>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <th colspan="7" class="text-right"> Total TAX </th>
                                        <th>
                                            <input type="text" readonly id="tax" name="tax"
                                                value="{{ old('tax') }}" class="form-control" autocomplete="off">
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Total VAT </th>
                                        <th>
                                            <input type="text" readonly id="vat" name="vat"
                                                value="{{ old('vat') }}" class="form-control" autocomplete="off">
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Grand Total </th>
                                        <th>
                                            <input type="text" readonly id="grand_total" name="grand_total"
                                                value="{{ old('grand_total', $sale_order->total) }}"
                                                class="form-control">
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Paid </th>
                                        <th>
                                            <input type="text" id="paid" name="paid"
                                                value="{{ old('paid', $sale_order->paid) }}" class="form-control"
                                                disabled>
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Due </th>
                                        <th>
                                            <input type="text" readonly id="due" name="due"
                                                value="{{ old('due', $sale_order->due) }}" class="form-control">
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Product Information</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Product Name</label>
                            <input disabled class="form-control" id="modal_product_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label> Product Category </label>
                            <input disabled class="form-control" id="modal_product_category_name">
                        </div>
                        <div class="form-group col-md-6">
                            <label> Buy Price </label>
                            <input disabled class="form-control" id="modal_buy_price">
                        </div>
                        <div class="form-group col-md-6">
                            <label> Sale Price </label>
                            <input disabled class="form-control" id="modal_sale_price">
                        </div>
                        <div class="form-group col-md-6">
                            <label> Warranty </label>
                            <input disabled class="form-control" id="modal_warranty">
                        </div>
                        <div class="form-group col-md-6">
                            <label> Guarantee </label>
                            <input disabled class="form-control" id="modal_guarantee">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-customer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Customer Information</h4>
                </div>
                <div class="modal-body">
                    <form id="customer-form" enctype="multipart/form-data" name="customer-form">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label> Mobile no. <span class="text-danger">*</span> </label>
                            <input class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter mobile no."
                                required>
                        </div>
                        <div class="form-group">
                            <label> Email </label>
                            <input class="form-control" name="email" id="email" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label>Address </label>
                            <input class="form-control" name="address" placeholder="Enter address">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="customer_store"> Save </button>
                </div>
            </div>
        </div>
    </div>
    <template id="template-product">
        <tr class="product-item">
            <td>
                <div class="form-group">
                    <input type="text" readonly class="form-control bg-blue code" name="code[]">
                    <input type="hidden" readonly class="form-control company_branch_ids" name="company_branch_ids[]">
                    <input type="hidden" class="form-control buy_price" name="buy_price[]">
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" readonly class="form-control product" name="product[]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="text" readonly class="form-control stock" name="stcok[]">
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
                    <input type="text" class="form-control product_discount" name="product_discount[]"
                        placeholder="Amount or %">
                    <input type="hidden" class="form-control product_tax" name="product_tax[]">
                    <input type="hidden" class="form-control product_vat" name="product_vat[]">
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
                    $("#bank_id option:selected").prop("selected", false);
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
                            // console.log(row.product_category)
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
                minLength: 2,
                delay: 250,
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
                    $(".company_branch_ids").each(function(index) {
                        if ($(this).val() != company_branch_id) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Can not add multiple branch same invoice.',
                            });
                            return false;
                        }
                    });
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
                                var html = $('#template-product').html();
                                var item = $(html);
                                item.find('.company_branch_ids').val(company_branch_id);
                                item.find('.code').val(response.data.code);
                                item.find('.product').val(response.data.name);
                                item.find('.stock').val(response.stock);
                                item.find('.quantity').val(1);
                                item.find('.unit_price').val(response.data.sale_price);
                                item.find('.buy_price').val(response.data.buy_price);
                                item.find('.product_tax').val(response.data.tax);
                                item.find('.product_vat').val(response.data.vat);
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
                        });
                    }
                    return false; // prevent the button click from happening
                }
            });
            $('body').on('click', '.code', function(e) {
                var company_branch_id = $('#company_branch_id').val();
                var code = $(this).val();
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
                        $('#modal_product_name').val(response.data.name);
                        $('#modal_product_category_name').val(response.data.product_category.name);
                        $('#modal_buy_price').val(response.data.buy_price);
                        $('#modal_sale_price').val(response.data.sale_price);
                        $('#modal_warranty').val(response.data.warranty);
                        $('#modal_guarantee').val(response.data.guarantee);
                        $('#modal-product').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'This product is not available',
                        });
                        calculate();
                    }
                });
            });


            $('body').on('click', '.btn-remove', function() {
                $(this).closest('.product-item').remove();
                calculate();

                if ($('.product-item').length <= 1) {
                    $('.btn-remove').hide();
                }

            });

            $('body').on('keyup', '#discount, #paid, .quantity, .unit_price, .product_discount', function() {
                calculate();
            });

            $('body').on('click', '#customer_add', function() {
                $('#modal-customer').modal('show');
            });
            $('body').on('click', '#customer_store', function() {
                storeCustomer();
            });

            function storeCustomer() {
                var formData = new FormData($('#customer-form')[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('store_new_customer') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#modal-customer').modal('hide');
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

            calculate();
        });

        function calculate() {
            var total = 0;
            var total_tax = 0;
            var total_vat = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = parseFloat($('.quantity:eq(' + i + ')').val() || 0);
                var unit_price = parseFloat($('.unit_price:eq(' + i + ')').val() || 0);
                var tax = parseFloat($('.product_tax:eq(' + i + ')').val() || 0);
                var vat = parseFloat($('.product_vat:eq(' + i + ')').val() || 0);
                var product_discount = $('.product_discount:eq(' + i + ')').val();
                var isProductPercentage = product_discount[product_discount.length - 1];
                if (isProductPercentage == '%') {
                    var product_percentage = parseFloat(product_discount.slice(0, -1));
                    product_discount = (product_percentage * (quantity * unit_price)) / 100;
                }
                product_discount = parseFloat(product_discount || 0);

                $('.total-cost:eq(' + i + ')').html('' + ((quantity * unit_price) - product_discount).toFixed(2));

                total += ((quantity * unit_price) - product_discount);
                total_tax += (tax * total) / 100;
                total_vat += (vat * total) / 100;
            });
            var discount = $('#discount').val();
            var isPercentage = discount[discount.length - 1];

            if (isPercentage == '%') {
                var percentage = parseFloat(discount.slice(0, -1));
                discount = (percentage * total) / 100;
            }
            discount = parseFloat(discount || 0);
            var paid = parseFloat($('#paid').val() || 0);
            var grand_total = parseFloat(total + total_tax + total_vat) - discount;
            var due = (grand_total - paid);
            $('#total-amount').html('' + total.toFixed(2));
            $('#tax').val(total_tax);
            $('#vat').val(total_vat);
            $('#grand_total').val(grand_total.toFixed(2));
            $('#due').val(due.toFixed(2));

        }

        $(document).ready(function() {
            $('#customer').select2({
                placeholder: 'Select customer',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_customers') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.mobile_no + ' - ' + item.name,
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
