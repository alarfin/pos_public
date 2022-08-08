@extends('layouts.app')
@section('purchase', 'active menu-open')
@section('purchase_order_create', 'active')

@section('style')
<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
<!-- jQuery UI -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
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
            <form method="POST" action="{{ route('purchase_order_create') }}">
                @csrf
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group {{ $errors->has('supplier') ? 'has-error' :'' }}">
                                <label>Supplier *</label>
                                <select class="form-control supplier" style="width: 100%;" name="supplier" id="supplier" data-placeholder="Select Supplier" required>
                                    <option value="">Select Supplier </option>
                                </select>

                                @error('supplier')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group {{ $errors->has('date') ? 'has-error' :'' }}">
                                <label>Date *</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="date" name="date" value="{{ empty(old('date')) ? ($errors->has('date') ? '' : date('Y-m-d')) : old('date') }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group {{ $errors->has('invoice_no') ? 'has-error' :'' }}">
                                <label> Invoice no *</label>

                                <div class="">
                                    <input type="text" readonly class="form-control" id="invoice_no" name="invoice_no" value="{{ old('invoice_no', $invoice_no) }}" autocomplete="off">
                                </div>
                                <!-- /.input group -->

                                @error('invoice_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group {{ $errors->has('note') ? 'has-error' :'' }}">
                                <label> Note </label>

                                <div class="">
                                    <input type="text" class="form-control" id="note" name="note" value="{{ old('note') }}" autocomplete="off">
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
                                <input type="search" class="form-control code" id="code" name="" autocomplete="off">
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
                        <th width="10%"> Quantity </th>
                        <th width="10%">Unit Price</th>
                        <th width="10%">Selling Price</th>
                        <th>Total Cost</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody id="product-container">
                    @if (old('product') != null && sizeof(old('product')) > 0)
                    @foreach(old('product') as $item)
                    <tr class="product-item">
                        <td>
                            <div class="form-group {{ $errors->has('product.'.$loop->index) ? 'has-error' :'' }}">
                                <select class="form-control product" style="width: 100%;" name="product[]" required>
                                    <option value="">Select Product</option>

                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ old('product.'.$loop->parent->index) == $product->id ? 'selected' : '' }}>{{ $product->code }} - {{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>

                        {{-- <td>
                                                <select class="form-control select2 {{ $errors->has('type.'.$loop->index) ? 'has-error' :'' }} type" name="type[]">
                        <option value="2">Multiple</option>
                        <option value="1" {{ old('type.'.$loop->index) == '1' ? 'selected' : '' }}>Single</option>
                        </select>
                        </td>

                        <td>
                            <div class="form-group {{ $errors->has('serial.'.$loop->index) ? 'has-error' :'' }}">
                                <input type="text" class="form-control serial" name="serial[]" value="{{ old('serial.'.$loop->index) }}">
                            </div>
                        </td> --}}

                        <td>
                            <div class="form-group {{ $errors->has('warranty.'.$loop->index) ? 'has-error' :'' }}">
                                <input type="text" class="form-control warranty" name="warranty[]" value="{{ old('warranty.'.$loop->index) }}">
                            </div>
                        </td>

                        <td>
                            <div class="form-group {{ $errors->has('quantity.'.$loop->index) ? 'has-error' :'' }}">
                                <input type="number" step="any" class="form-control quantity" name="quantity[]" value="{{ old('quantity.'.$loop->index) }}">
                            </div>
                        </td>

                        <td>
                            <div class="form-group {{ $errors->has('unit_price.'.$loop->index) ? 'has-error' :'' }}">
                                <input type="text" class="form-control unit_price" name="unit_price[]" value="{{ old('unit_price.'.$loop->index) }}">
                            </div>
                        </td>

                        {{-- <td>
                                                <div class="form-group {{ $errors->has('including_price.'.$loop->index) ? 'has-error' :'' }}">
                        <input type="text" class="form-control including_price" name="including_price[]" value="{{ old('including_price.'.$loop->index) }}">
        </div>
        </td> --}}

        <td>
            <div class="form-group {{ $errors->has('selling_price.'.$loop->index) ? 'has-error' :'' }}">
                <input type="text" class="form-control selling_price" name="selling_price[]" value="{{ old('selling_price.'.$loop->index) }}">
                <input type="hidden" class="form-control including_price" name="including_price[]" value="{{ old('including_price.'.$loop->index) }}">
            </div>
        </td>

        <td class="total-cost">0.00</td>
        <td class="text-center">
            <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
        </td>
        </tr>
        @endforeach
        @else
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
                    <input type="text" class="form-control stock" name="stcok[]">
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
        @endif
        </tbody>

        <tfoot>
            <tr>
                <td>
                    <a role="button" class="btn btn-info btn-sm" id="btn-add-product">Add Product</a>
                </td>
                <th colspan="4" class="text-right">Total Amount</th>
                <th id="total-amount">0.00</th>
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
                <input type="text" class="form-control stock" name="stcok[]">
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
<script src="{{ asset('themes/backend/js/sweetalert2.js') }}"></script>
<!-- jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    $(function() {
        //Initialize Select2 Elements
        // $('.select2').select2();

        //Date picker
        $('#date').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('.code').autocomplete({
            source: function(request, response) {
                $.getJSON('{{ route("get_products_by_code") }}?term=' + request.term, function(data) {
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
            delay: 500,
        });

        $('body').on('keypress', '.code', function(e) {
            if (e.keyCode == 13) {
                var code = $(this).val();
                $this = $(this);
                var serials = [];
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
                            code: code
                        }
                    }).done(function(response) {
                        // console.log(response);
                        if (response.success) {
                            var html = '<tr class="product-item"> <td> <div class="form-group"> <input type="text" readonly class="form-control" value="' + response.data.code + '" name="code[]"> </div></td><td> <div class="form-group"> <input type="text" readonly class="form-control product" name="product[]" value="' + response.data.name + '"> </div></td><td> <div class="form-group"> <input type="text" class="form-control stock" name="stcok[]" value="' + response.data.stockReport.stock_quantity + '"> </div></td><td> <div class="form-group"> <input type="number" step="any" class="form-control quantity" name="quantity[]" value="1"> </div></td><td> <div class="form-group"> <input type="text" class="form-control unit_price" name="unit_price[]" value="0"> </div></td><td> <div class="form-group"> <input type="text" class="form-control selling_price" name="selling_price[]" value="0"> </div></td><td class="total-cost">0.00</td><td class="text-center"> <a role="button" class="btn btn-danger btn-sm btn-remove">X</a> </td></tr>';
                            $('#product-container').append(html);
                            // calculate();
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


        $('body').on('click', '.btn-remove', function() {
            $(this).closest('.product-item').remove();
            calculate();

            if ($('.product-item').length <= 1) {
                $('.btn-remove').hide();
            }
        });

        $('body').on('keyup', '.quantity, .unit_price', function() {
            calculate();
        });

        if ($('.product-item').length <= 1) {
            $('.btn-remove').hide();
        } else {
            $('.btn-remove').show();
        }

        calculate();
    });

    function calculate() {
        var total = 0;

        $('.product-item').each(function(i, obj) {
            var quantity = $('.quantity:eq(' + i + ')').val();
            var unit_price = $('.unit_price:eq(' + i + ')').val();

            if (quantity == '' || quantity < 0 || !$.isNumeric(quantity))
                quantity = 0;

            if (unit_price == '' || unit_price < 0 || !$.isNumeric(unit_price))
                unit_price = 0;

            $('.total-cost:eq(' + i + ')').html('' + (quantity * unit_price).toFixed(2));
            total += quantity * unit_price;
        });

        $('#total-amount').html('' + total.toFixed(2));
    }

    function initProduct() {
        $('.select2,.product').select2();
    }

    $(document).ready(function() {
        $('#supplier').select2({
            placeholder: 'Select Supplier',
            minimumInputLength: 0,
            ajax: {
                url: '{{ route("get_supplier") }}',
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