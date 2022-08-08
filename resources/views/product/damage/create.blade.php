@extends('layouts.app')
@section('product', 'active menu-open')
@section('product_damage', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Add damage product
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
                <form method="POST" action="{{ route('product_damage_create') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('invoice_no') ? 'has-error' : '' }}">
                                    <label> Company Branch *</label>

                                    <select name="company_branch_id" id="company_branch_id" class="form-control select2"
                                        required>
                                        {{-- <option value="">Select branch </option> --}}
                                        @foreach ($company_branches as $company_branch)
                                            <option value="{{ $company_branch->id }}"
                                                @if (old('company_branch_id') == $company_branch->id) selected @endif>
                                                {{ $company_branch->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('invoice_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4">
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
                                    <label for=""> Enter the product code </label>
                                    <input type="search" class="form-control code" id="code" name="" autofocus
                                        autocomplete="off">
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
                                        <th width="10%">Buy Price</th>
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
                                                        <input type="text" readonly class="form-control product_code"
                                                            name="code[]" value="{{ old('code.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('product.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" readonly class="form-control product"
                                                            name="product[]" value="{{ old('product.' . $loop->index) }}">
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
                                                        class="form-group {{ $errors->has('quantity.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="number" step="any" class="form-control quantity"
                                                            name="quantity[]"
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
                                                        class="form-group {{ $errors->has('buy_price.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input readonly type="text" class="form-control buy_price"
                                                            name="buy_price[]"
                                                            value="{{ old('buy_price.' . $loop->index) }}">
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
                                        <th colspan="6" class="text-right">Total Amount</th>
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
                    <input type="text" class="form-control stock" name="stock[]">
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
                    <input readonly type="text" class="form-control buy_price" name="buy_price[]">
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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

            $('body').on('keypress', '.code', function(e) {
                if (e.keyCode == 13) {
                    var code = $(this).val();
                    $this = $(this);
                    var serials = [];

                    $(".product_code").each(function(index) {
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
                                code: code
                            }
                        }).done(function(response) {
                            // console.log(response);
                            if (response.success) {
                                var html =
                                    '<tr class="product-item"> <td> <div class="form-group"> <input type="text" readonly class="form-control product_code" value="' +
                                    response.data.code +
                                    '" name="code[]"> </div></td><td> <div class="form-group"> <input type="text" readonly class="form-control product" name="product[]" value="' +
                                    response.data.name +
                                    '"> </div></td><td> <div class="form-group"> <input type="text" class="form-control stock" readonly name="stock[]" value="' +
                                    response.stock +
                                    '"> </div></td><td> <div class="form-group"> <input type="text" class="form-control quantity" name="quantity[]" value="1"> </div></td><td> <div class="form-group"> <input type="text" class="form-control unit_price" name="unit_price[]" value="' +
                                    response.data.buy_price +
                                    '"> </div></td><td> <div class="form-group"> <input type="text" radonly class="form-control buy_price" name="buy_price[]" value="' +
                                    response.data.buy_price +
                                    '"> </div></td><td class="total-cost">0.00</td><td class="text-center"> <a role="button" class="btn btn-danger btn-sm btn-remove">X</a> </td></tr>';
                                $('#product-container').append(html);
                                $('.code').val('');
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
            $('#total-amount').html('' + total.toFixed(2));

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
