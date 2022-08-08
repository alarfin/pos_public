@extends('layouts.app')
@section('purchase', 'active menu-open')
@section('purchase_order_manage', 'active')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .billing_box {
            padding: 5px 10px;
            border: 2px solid #cccccc;
            display: inline-block;
            margin: 5px 0px;
        }

        .table th {
            padding: 4px 5px !important;
            vertical-align: middle;
        }

        .table td {
            padding: 3px 5px !important;
            vertical-align: middle;
        }
    </style>
@endsection

@section('title')
    Purchase Order Details
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <a role="button" class="btn btn-primary" onclick="getPrint()">Print</a>
                        </div>
                    </div>

                    <hr>
                    <div id="print_area">
                        <div class="row">
                            <div class="col-xs-8">
                                <div>
                                    <img src="{{ url('storage/app/' . $setting->logo) }}" alt="Logo" height="50">
                                </div>
                                <div class="billing_box">
                                    Billing From
                                </div>
                                <div class="company_info">
                                    {{ $setting->address }} <br>
                                    <b>Mobile:</b> {{ $setting->mobile_no }} <br>
                                    <b>Email:</b> {{ $setting->email }} <br>
                                    <b>Web:</b> {{ $setting->web }} <br>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div>
                                    <h3>Purchase</h3>
                                    <b>Invoice no:</b> {{ $purchase_order->invoice_no }} <br>
                                    <b>Invoice Date:</b> {{ $purchase_order->date->format('d-m-Y') }} <br>
                                </div>
                                <div class="billing_box">
                                    Billing To
                                </div>
                                <div class="supplier_info">
                                    <b>{{ $purchase_order->supplier->name ?? '' }}</b> <br>
                                    Mobile: {{ $purchase_order->supplier->mobile_no ?? '' }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> SL. </th>
                                            <th class="text-center"> Code </th>
                                            <th class="text-left">Product Name</th>
                                            <th class="text-left"> Color </th>
                                            <th class="text-left"> Size </th>
                                            <th class="text-left">Product Category</th>
                                            <th class="text-left">Serial no</th>
                                            <th class="text-right">Return</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Unit Price</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($purchase_order->products as $purchase_order_product)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $purchase_order_product->code }}</td>
                                                <td class="text-left">{{ $purchase_order_product->name }}</td>
                                                <td class="text-left">
                                                    {{ $purchase_order_product->product->productColor->name ?? '' }}
                                                </td>
                                                <td class="text-left">
                                                    {{ $purchase_order_product->product->productSize->name ?? '' }}
                                                </td>
                                                <td class="text-left">
                                                    {{ $purchase_order_product->product->productCategory->name ?? '' }}
                                                </td>
                                                <td class="text-left">{{ $purchase_order_product->serial_no }}
                                                <td class="text-right">{{ $purchase_order_product->return_quantity }}
                                                </td>
                                                <td class="text-right">{{ $purchase_order_product->quantity }}</td>
                                                <td class="text-right">
                                                    {{ number_format($purchase_order_product->unit_price, 2) }}</td>
                                                <td class="text-right">
                                                    {{ number_format($purchase_order_product->total, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-offset-8 col-xs-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-right">Product Amount</th>
                                        <td class="text-right">{{ number_format($purchase_order->sub_total, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"> Discount </th>
                                        <td class="text-right">{{ number_format($purchase_order->discount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"> Grand Total </th>
                                        <td class="text-right">{{ number_format($purchase_order->total, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"> Paid </th>
                                        <td class="text-right">{{ number_format($purchase_order->paid, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"> Due Amount </th>
                                        <td class="text-right">{{ number_format($purchase_order->due, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function() {
            //
        });

        function getPrint() {
            var html = $('body').html($('#print_area').html());
            window.print(html);
            window.location.replace('{!! url()->full() !!}');
        }
    </script>
@endsection
