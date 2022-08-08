@extends('layouts.app')
@section('return', 'active menu-open')
@section('purchase_return_create', 'active')

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
    Purchase Return
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
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
                    <h3 class="box-title">Filter</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <form action="{{ route('purchase_return') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="">
                                        <input type="text" class="form-control" name="invoice_no" id="invoice_no"
                                            placeholder="Enter purchase invoice no." autocomplete="off" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-primary"> Search </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($purchase_order)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="POST" action="{{ route('purchase_return') }}">
                        @csrf
                        <input type="hidden" name="purchase_order_id" value="{{ $purchase_order->id }}">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('supplier') ? 'has-error' : '' }}">
                                        <label>Supplier </label>
                                        <input type="text" name="supplier"
                                            value="{{ old('supplier', $purchase_order->supplier->name ?? '') }}"
                                            class="form-control" disabled>
                                        @error('supplier')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                        <label>Date </label>
                                        <input type="text"
                                            value="{{ old('date', $purchase_order->date->format('Y-m-d')) }}"
                                            class="form-control" disabled>
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
                                                name="invoice_no"
                                                value="{{ old('invoice_no', $purchase_order->invoice_no) }}"
                                                autocomplete="off" disabled>
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
                                                @if ($purchase_order->payment_method == 1)
                                                    <option value="1" @if (old('payment_method') == 1) selected @endif>
                                                        Cash In Hand </option>
                                                @else
                                                    <option value="2" @if (old('payment_method') == 2) selected @endif>
                                                        Bank </option>
                                                @endif
                                            </select>
                                        </div>

                                        @error('payment_method')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                                        <label> Note </label>

                                        <div class="">
                                            <input type="text" class="form-control" id="note" name="note"
                                                value="{{ old('note', $purchase_order->note) }}" autocomplete="off"
                                                disabled>
                                        </div>
                                        <!-- /.input group -->

                                        @error('note')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> Code </th>
                                            <th width="20%"> Product </th>
                                            <th width="10%"> Total QTY </th>
                                            <th width="10%"> Prev. Return </th>
                                            <th width="10%"> Quantity </th>
                                            <th width="10%"> Return </th>
                                            <th width="10%">Unit Price</th>
                                            <th>Total Cost</th>
                                        </tr>
                                    </thead>

                                    <tbody id="product-container">
                                        @foreach ($purchase_order->products ?? [] as $order_product)
                                            <tr class="product-item">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="purchase_order_product_ids[]"
                                                            value="{{ $order_product->id }}">
                                                        <input type="text" readonly class="form-control product_code"
                                                            name="code[]" value="{{ $order_product->code }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control product"
                                                            name="product[]" value="{{ $order_product->name }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any" class="form-control total_quantity"
                                                            name="total_quantity[]"
                                                            value="{{ $order_product->quantity + $order_product->return_quantity }}"
                                                            disabled>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any" class="form-control prev_return"
                                                            name="prev_return[]"
                                                            value="{{ $order_product->return_quantity }}" disabled>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any" class="form-control quantity"
                                                            name="quantity[]" value="{{ $order_product->quantity }}"
                                                            disabled>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any" class="form-control return_quantity"
                                                            max="{{ $order_product->quantity }}" name="return_quantity[]"
                                                            value="0">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control unit_price"
                                                            name="unit_price[]" value="{{ $order_product->unit_price }}"
                                                            disabled>
                                                    </div>
                                                </td>

                                                <td class="total-cost">0.00</td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            {{-- <td>
                                                <a role="button" class="btn btn-info btn-sm" id="btn-add-product">Add Product</a>
                                            </td> --}}
                                            <th colspan="7" class="text-right">Product Amount</th>
                                            <th id="total-amount">0.00</th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right"> Discount </th>
                                            <th>
                                                <input type="text" id="discount" name="discount"
                                                    value="{{ old('discount', $purchase_order->discount) }}"
                                                    placeholder="Amount or %" class="form-control" autocomplete="off"
                                                    disabled>
                                                {{-- <small> Discount in amount as 100, Discount in percentage as 5%  </small> --}}
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right"> Grand Total </th>
                                            <th>
                                                <input type="text" readonly id="grand_total" name="grand_total"
                                                    value="{{ old('grand_total', $purchase_order->total) }}"
                                                    class="form-control">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right"> Paid </th>
                                            <th>
                                                <input type="text" id="paid" name="paid"
                                                    value="{{ old('paid', $purchase_order->paid) }}"
                                                    class="form-control" autocomplete="off" disabled>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right"> Due </th>
                                            <th>
                                                <input type="text" readonly id="due" name="due"
                                                    value="{{ old('due', $purchase_order->due) }}"
                                                    class="form-control">
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right"> Supplier Return Amount </th>
                                            <th>
                                                <input type="text" id="return_amount" name="return_amount" value="0"
                                                    class="form-control">
                                            </th>
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
    @endif

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <!-- jQuery UI -->
    <script src="{{ asset('themes/backend/js/jquery-ui.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
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

            $('.code').autocomplete({
                source: function(request, response) {
                    $.getJSON('{{ route('get_products_by_code') }}?term=' + request.term, function(
                        data) {
                        var array = $.map(data, function(row) {
                            return {
                                value: row.code,
                                label: row.code + '-' + row.name
                            }
                        });

                        response($.ui.autocomplete.filter(array, request.term));
                    })
                },
                minLength: 3,
                delay: 250,
            });

            $('body').on('keyup', '.return_quantity, .quantity, .unit_price', function() {
                calculate();
            });
            $('body').on('change', '.return_quantity, .quantity, .unit_price', function() {
                calculate();
            });

            calculate();
        });

        function calculate() {
            var total = 0;

            $('.product-item').each(function(i, obj) {
                var quantity = parseFloat($('.quantity:eq(' + i + ')').val() || 0);
                var return_quantity = parseFloat($('.return_quantity:eq(' + i + ')').val() || 0);
                var unit_price = parseFloat($('.unit_price:eq(' + i + ')').val() || 0);
                quantity = quantity - return_quantity;
                $('.total-cost:eq(' + i + ')').html('' + (quantity * unit_price).toFixed(2));
                total += quantity * unit_price;
            });
            var discount = $('#discount').val();
            if (total == 0) {
                discount = $('#discount').val(0);
            }
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
