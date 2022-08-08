@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('account_adjustment', 'display: block')
@section('account_adjustments', 'active')

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
    Account Adjustment Details
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
                                    <h3> Account Adjustment  </h3>
                                    <b>Voucher no:</b> {{ $transaction_log->voucher_no}} <br>
                                    <b> Voucher Date:</b> {{ $transaction_log->date->format('d-m-Y')}} <br>
                                </div>
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
                                            <th class="text-right"> Debit </th>
                                            <th class="text-right"> Credit </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="text-center"> 1 </td>
                                            <td class="text-left">{{ $transaction_log->account->name??'' }}</td>
                                            <td class="text-left">{{ $transaction_log->note }}</td>
                                            <td class="text-right">{{ number_format($transaction_log->debit, 2) }}</td>
                                            <td class="text-right">{{ number_format($transaction_log->credit, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-offset-8 col-xs-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-right">Total Amount</th>
                                        <td class="text-right">{{ number_format($transaction_log->amount, 2) }}</td>
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
