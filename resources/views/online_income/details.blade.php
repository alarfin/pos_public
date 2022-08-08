@extends('layouts.app')
@section('online_income', 'active menu-open')
@section('online_income_manage', 'active')

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
    Online Income Details
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
                                <div class="company_info">
                                    {{ $setting->address }} <br>
                                    <b>Mobile:</b> {{ $setting->mobile_no }} <br>
                                    <b>Email:</b> {{ $setting->email }} <br>
                                    <b>Web:</b> {{ $setting->web }} <br>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div>
                                    <h3> Income </h3>
                                    <b> Serial no: </b> {{ $online_income->serial_no }} <br>
                                    <b> Date: </b> {{ $online_income->date->format('d-m-Y') }} <br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th> Branch name </th>
                                        <th> Income account </th>
                                        <th> Note </th>
                                        <th class="text-right"> Quantity </th>
                                        <th class="text-right"> Amount </th>
                                    </tr>
                                    <tr>
                                        <td> {{ $online_income->companyBranch->name ?? '' }} </td>
                                        <td> {{ $online_income->account->name ?? '' }} </td>
                                        <td> {{ $online_income->note }} </td>
                                        <td class="text-right"> {{ $online_income->quantity }} </td>
                                        <td class="text-right"> {{ number_format($online_income->amount, 2) }} </td>
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
