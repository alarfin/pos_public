<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--Favicon-->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon" />

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-8">
            <div>
                <img src="{{ url('storage/app/'.$setting->logo) }}" alt="Logo" height="50">
            </div>
            <div class="billing_box">
                Billing From
            </div>
            <div class="company_info">
                {{ $setting->address}} <br>
                <b>Mobile:</b> {{ $setting->mobile_no}} <br>
                <b>Email:</b> {{ $setting->email}} <br>
                <b>Web:</b> {{ $setting->web}} <br>
            </div>
        </div>

        <div class="col-xs-4">
            <div>
                <h3>Purchase</h3>
                <b>Invoice no:</b> {{ $purchase_order->invoice_no}} <br>
                <b>Invoice Date:</b> {{ $purchase_order->date->format('d-m-Y')}} <br>
            </div>
            <div class="billing_box">
                Billing To
            </div>
            <div class="supplier_info">
                <b>{{ $purchase_order->supplier->name??''}}</b> <br>
                Mobile: {{ $purchase_order->supplier->mobile_no??''}}
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
                        <th class="text-left">Product Category</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Unit Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($purchase_order->products as $purchase_order_product)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $purchase_order_product->code }}</td>
                            <td class="text-left">{{ $purchase_order_product->name }}</td>
                            <td class="text-left">{{ $purchase_order_product->category->name??'' }}</td>
                            <td class="text-right">{{ $purchase_order_product->quantity }}</td>
                            <td class="text-right">{{ number_format($purchase_order_product->unit_price, 2) }}</td>
                            <td class="text-right">{{ number_format($purchase_order_product->total, 2) }}</td>
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
                    <th class="text-right">Total Amount</th>
                    <td class="text-right">{{ number_format($purchase_order->sub_total, 2) }}</td>
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


<script>
    window.print();
    window.onafterprint = function(){ window.close()};
</script>
</body>
</html>
