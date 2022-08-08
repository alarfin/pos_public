@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_balance_summary', 'active')
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- daterange picker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <style>
        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #000 !important;
        }

        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 0px 8px !important;
            vertical-align: middle !important;
        }
    </style>
@endsection

<?php
use SakibRahaman\DecimalToWords\DecimalToWords;
?>
@section('title')
    Daily Cash Status
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_balance_summary') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Start Date *</label>
                                    <div class="col-sm-12">
                                        <input type="text" name="date" class="form-control date"
                                            value="{{ date('Y-m-d', strtotime($searchData['date'])) }}">
                                        @error('date')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label> &nbsp;</label>

                                    <input class="btn btn-primary form-control" type="submit" value="Search">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <section class="panel">
                <div class="panel-body">
                    <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><br>
                    <div id="prinarea">
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
                                    <h3> Daily Balance Summary </h3>
                                    <b> Date:
                                        {{ date('d M-Y', strtotime($searchData['date'])) }}
                                    </b>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="2"> Opening Balance </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="text-right">Total Opening Balance </th>
                                                <th class="text-right">
                                                    {{ number_format($opening_balance, 2) }}
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @php
                                                $total_income = 0;
                                            @endphp
                                            @foreach ($creadit_accounts as $account)
                                                @php
                                                    $income = $account->balance($searchData);
                                                    $total_income += $income;
                                                @endphp
                                                <tr>
                                                    <th> {{ $account->name }} </th>
                                                    <td class="text-right">
                                                        {{ number_format($income, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @php
                                                $total_expense = 0;
                                            @endphp
                                            @foreach ($debit_accounts as $account)
                                                @php
                                                    $expense = $account->balance($searchData);
                                                    $total_expense += $expense;
                                                @endphp
                                                <tr>
                                                    <th> {{ $account->name }} </th>
                                                    <td class="text-right">
                                                        {{ number_format($expense, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" colspan="2"> Closing Balance </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th class="text-right">Total Closing Balance </th>
                                                <th class="text-right">
                                                    {{ number_format($opening_balance + ($total_income - $total_expense), 2) }}
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                Printed By {{ Auth::user()->name }}, Printing Time: {{ date('d M-Y h:i a') }}
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>

    <script>
        $(function() {
            $('.select2').select2();
            $('.date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

        });
    </script>
    <script>
        var APP_URL = '{!! url()->full() !!}';

        function getprint(prinarea) {
            $("div").removeClass("table-responsive");
            $('body').html($('#' + prinarea).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
