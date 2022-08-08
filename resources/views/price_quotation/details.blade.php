@extends('layouts.app')
@section('price_quotation', 'active menu-open')
@section('price_quotation_manage', 'active')

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
    Price Quotation Details
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
                                    Quotation From
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
                                    <h3>Price Quotation </h3>
                                    <b>Quotation no:</b> {{ $price_quotation->invoice_no }} <br>
                                    <b>Quotation Date:</b> {{ $price_quotation->date->format('d-m-Y') }} <br>
                                </div>
                                <div class="billing_box">
                                    Quotation To
                                </div>
                                <div class="customer_info">
                                    <b>{{ $price_quotation->customer->name ?? '' }}</b> <br>
                                    Mobile: {{ $price_quotation->customer->mobile_no ?? '' }}
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
                                            <th class="text-left">Product</th>
                                            <th class="text-left"> Category</th>
                                            <th class="text-left">Serial no</th>
                                            <th class="text-left"> Warranty & Guarantee </th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Unit Price</th>
                                            <th class="text-right">P. Discount</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($price_quotation->products as $price_quotation_product)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $price_quotation_product->code }}</td>
                                                <td class="text-left">{{ $price_quotation_product->name }}</td>
                                                <td class="text-left">
                                                    {{ $price_quotation_product->productCategory->name ?? '' }}
                                                </td>
                                                <td class="text-left">{{ $price_quotation_product->serial_no }}</td>
                                                <td class="text-left">
                                                    @if ($price_quotation_product->warranty)
                                                        <b> Warranty : </b> {{ $price_quotation_product->warranty }} <br>
                                                    @endif
                                                    @if ($price_quotation_product->guarantee)
                                                        <b>Guarantee : </b> {{ $price_quotation_product->guarantee }}
                                                    @endif
                                                </td>
                                                <td class="text-right">{{ $price_quotation_product->quantity }}</td>
                                                <td class="text-right">
                                                    {{ number_format($price_quotation_product->unit_price, 2) }}</td>
                                                <td class="text-right">
                                                    {{ number_format($price_quotation_product->discount, 2) }}</td>
                                                <td class="text-right">
                                                    {{ number_format($price_quotation_product->total - $price_quotation_product->tax - $price_quotation_product->vat, 2) }}
                                                </td>
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
                                        <td class="text-right">
                                            {{ number_format($price_quotation->sub_total - $price_quotation->tax - $price_quotation->vat, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"> Discount </th>
                                        <td class="text-right">{{ number_format($price_quotation->discount, 2) }}
                                        </td>
                                    </tr>
                                    @if ($price_quotation->tax > 0)
                                        <tr>
                                            <th class="text-right"> Total TAX </th>
                                            <td class="text-right">{{ number_format($price_quotation->tax, 2) }}</td>
                                        </tr>
                                    @endif
                                    @if ($price_quotation->vat > 0)
                                        <tr>
                                            <th class="text-right"> Total VAT </th>
                                            <td class="text-right">{{ number_format($price_quotation->vat, 2) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th class="text-right"> Grand Total </th>
                                        <td class="text-right">{{ number_format($price_quotation->total, 2) }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <br><br>
                            <div class="col-xs-4">
                                <div class="received_by">
                                    Received By
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="authorized_by text-center">
                                    Authorized By
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="approved_by text-right">
                                    Approved By
                                </div>
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
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}">
    </script>

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
