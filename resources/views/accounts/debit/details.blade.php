@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('debit_transaction', 'display: block')
@section('debit_transactions', 'active')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .billing_box{
            padding: 5px 10px;
            border: 2px solid #cccccc;
            display: inline-block;
            margin: 5px 0px;
        }
        .table>thead>tr>th, .table>thead>tr>td {
            padding: 5px !important;
            vertical-align: middle;
        }
    </style>
@endsection

@section('title')
    Debit Transaction Details
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
                                    <h3> Debit Transaction </h3>
                                    <b>Transaction no:</b> {{ $transaction->transaction_no}} <br>
                                    <b> Transaction Date:</b> {{ $transaction->date->format('d-m-Y')}} <br>
                                </div>
                                <div class="billing_box">
                                    Billing To
                                </div>
                                @if ($transaction->employee_id)
                                    <div class="supplier_info">
                                        <b>{{ $transaction->employee->name??''}}</b> <br>
                                        Mobile: {{ $transaction->employee->mobile_no??''}}
                                    </div>
                                @endif
                                @if ($transaction->supplier_id)
                                    <div class="supplier_info">
                                        <b>{{ $transaction->supplier->name??''}}</b> <br>
                                        Mobile: {{ $transaction->supplier->mobile_no??''}}
                                    </div>
                                @endif

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th class="text-center"> SL. </th>
                                            <th class="text-left"> Account name </th>
                                            <th class="text-left"> Note </th>
                                            <th class="text-right"> Amount </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($transaction->debitTransactionLog as $transaction_log)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-left">{{ $transaction_log->account->name??'' }}</td>
                                                <td class="text-left">{{ $transaction_log->note }}</td>
                                                <td class="text-right">{{ number_format($transaction_log->debit, 2) }}</td>
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
                                        <td class="text-right">{{ number_format($transaction->amount, 2) }}</td>
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
        $(function () {
            //
        });

        function getPrint(){
            var html = $('body').html($('#print_area').html());
            window.print(html);
            window.location.replace('{!! url()->full()  !!}');
        }
    </script>
@endsection
