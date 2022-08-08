@extends('layouts.app')
@section('purchase', 'active menu-open')
@section('purchase_order_manage', 'active')

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
                    <h3 class="box-title">Order Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('purchase_order_edit', ['purchase_order' => $purchase_order->id]) }}">
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
                                                    @if (old('company_branch_id', $purchase_order->company_branch_id) == $branch->id) selected @endif> {{ $branch->name }}
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
                                    <select class="form-control supplier" style="width: 100%;" name="supplier"
                                        id="supplier" data-placeholder="Select Supplier" required>
                                        @if (old('customer'))
                                            <option value="{{ old('customer') }}" selected>
                                                {{ App\Models\Customer::find(old('customer'))->name ?? '' }} </option>
                                        @else
                                            <option value="{{ $purchase_order->supplier_id }}">
                                                {{ $purchase_order->supplier->name ?? '' }} </option>
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
                                            value="{{ old('date', date('Y-m-d', strtotime($purchase_order->date))) }}"
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
                                            name="invoice_no" value="{{ old('invoice_no', $purchase_order->invoice_no) }}"
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
                                            <option value="1" @if (old('payment_method', $purchase_order->payment_method) == 1) selected @endif> Cash
                                                In
                                                Hand </option>
                                            <option value="2" @if (old('payment_method', $purchase_order->payment_method) == 2) selected @endif> Bank
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
                                                    @if (old('bank_id', $purchase_order->bank_id) == $bank->id) selected @endif>
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
                                            value="{{ old('note', $purchase_order->note) }}" autocomplete="off">
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
                                        <th width="20%"> Serial </th>
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
                                                        <input type="text" class="form-control stock" name="stock[]"
                                                            value="{{ old('stock.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('serial_no.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control serial_no"
                                                            name="serial_no[]"
                                                            value="{{ old('serial_no.' . $loop->index) }}">
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
                                        @foreach ($purchase_order->products as $purchase_product)
                                            <tr class="product-item">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control code"
                                                            name="code[]" value="{{ $purchase_product->code }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control product"
                                                            name="product[]" value="{{ $purchase_product->name }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" readonly class="form-control stock"
                                                            name="stock[]"
                                                            value="{{ $purchase_product->product->stockQuantity() - $purchase_product->quantity }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control serial_no"
                                                            name="serial_no[]"
                                                            value="{{ $purchase_product->serial_no }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="any"
                                                            class="form-control quantity" name="quantity[]"
                                                            value="{{ $purchase_product->quantity }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control unit_price"
                                                            name="unit_price[]"
                                                            value="{{ $purchase_product->unit_price }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control selling_price"
                                                            name="selling_price[]"
                                                            value="{{ $purchase_product->product->sale_price }}">
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
                                                value="{{ old('discount', $purchase_order->discount) }}"
                                                placeholder="Amount or %" class="form-control" autocomplete="off">
                                            {{-- <small> Discount in amount as 100, Discount in percentage as 5%  </small> --}}
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Grand Total </th>
                                        <th>
                                            <input type="text" readonly id="grand_total" name="grand_total"
                                                value="{{ old('grand_total', $purchase_order->total) }}"
                                                class="form-control">
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Paid </th>
                                        <th>
                                            <input type="text" readonly id="paid" name="paid"
                                                value="{{ old('paid', $purchase_order->paid) }}" class="form-control">
                                        </th>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-right"> Due </th>
                                        <th>
                                            <input type="text" readonly id="due" name="due"
                                                value="{{ old('due', $purchase_order->due) }}" class="form-control">
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
