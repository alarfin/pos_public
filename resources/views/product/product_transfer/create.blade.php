@extends('layouts.app')
@section('product', 'active menu-open')
@section('product_transfer_manage', 'active')

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
    Product Transfer
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
                    <h3 class="box-title">Product Transfer Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('product_transfer_create') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('source_branch_id') ? 'has-error' : '' }}">
                                    <label> Select Source Branch *</label>
                                    <div class="">
                                        <select name="source_branch_id" id="source_branch_id" class="form-control select2"
                                            required>
                                            @foreach ($company_branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('source_branch_id') == $branch->id) selected @endif> {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('source_branch_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('target_branch_id') ? 'has-error' : '' }}">
                                    <label> Select Target Branch *</label>
                                    <div class="">
                                        <select name="target_branch_id" id="target_branch_id" class="form-control select2"
                                            required>
                                            <option value="">Select target branch </option>
                                            @foreach ($company_branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('target_branch_id') == $branch->id) selected @endif> {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('target_branch_id')
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
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('product') ? 'has-error' : '' }}">
                                    <label> Product <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control product_id select2" name="product_id" id="product_id"
                                        data-placeholder="Select product" required>
                                        <option value=""> Select product </option>
                                        @if (old('product_id'))
                                            <option value="{{ old('product_id') }}" selected>
                                                @php
                                                    $product = App\Models\Product::find(old('product_id'));
                                                @endphp
                                                {{ $product->code ?? '' }} - {{ $product->name ?? '' }}
                                            </option>
                                        @endif
                                    </select>

                                    @error('product_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('stock') ? 'has-error' : '' }}">
                                    <label> Stock </label>

                                    <div class="">
                                        <input type="text" readonly class="form-control" id="stock" name="stock"
                                            value="{{ old('stock', 0) }}" autocomplete="off">
                                    </div>
                                    @error('stock')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                    <label> Quantity *</label>

                                    <div class="">
                                        <input type="number" step="any" class="form-control" id="quantity"
                                            name="quantity" value="{{ old('quantity', 0) }}" autocomplete="off">
                                    </div>
                                    @error('quantity')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('buy_price') ? 'has-error' : '' }}">
                                    <label> Buy price *</label>

                                    <div class="">
                                        <input type="number" step="any" class="form-control" id="buy_price"
                                            name="buy_price" value="{{ old('buy_price', 0) }}" autocomplete="off">
                                    </div>
                                    @error('buy_price')
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
                                    @error('note')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

            $('body').on('change', '#product_id,#source_branch_id', function(e) {
                var product_id = $('#product_id').val();
                var company_branch_id = $('#source_branch_id').val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_branch_product_stock') }}",
                    data: {
                        product_id: product_id,
                        company_branch_id: company_branch_id
                    }
                }).done(function(response) {
                    $('#stock').val(response.stock);
                    $('#buy_price').val(response.product.buy_price);
                    $('#quantity').attr({
                        "max": response.stock,
                        "min": 0
                    })
                });
            });
        });

        $(document).ready(function() {
            var company_branch_id = $('#source_branch_id').val();
            $('#product_id').select2({
                placeholder: 'Select product',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_transfer_product') }}',
                    data: {
                        company_branch_id: company_branch_id
                    },
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.code + ' - ' + item.name + ' - ' + item
                                        .product_color.name + ' - ' + item.product_size.name,
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
