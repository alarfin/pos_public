@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_net_profit_loss', 'active')
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('style')
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
    </style>
@endsection
<?php
use SakibRahaman\DecimalToWords\DecimalToWords;
?>
@section('title')
    Net Profit Loss
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_net_profit_loss') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label> Company branch </label>
                                    <select class="form-control select2" name="company_branch_id" id="company_branch_id">
                                        <option value="">Select branch</option>
                                        @foreach ($company_branches as $company_branch)
                                            <option value="{{ $company_branch->id }}"
                                                @if (old('company_branch_id', request()->get('company_branch_id')) == $company_branch->id) selected @endif>
                                                {{ $company_branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('company_branch_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" id="start_date"
                                            name="start_date" value="{{ old('start_date', request()->get('start_date')) }}"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" id="end_date"
                                            name="end_date" value="{{ old('end_date', request()->get('end_date')) }}"
                                            autocomplete="off">
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-3">
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
                                <br>
                                <div class="company_info">
                                    {{ $setting->address }} <br>
                                    <b>Mobile:</b> {{ $setting->mobile_no }} <br>
                                    <b>Email:</b> {{ $setting->email }} <br>
                                    <b>Web:</b> {{ $setting->web }} <br>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div>
                                    <h3> Net Profit Loss </h3>
                                    <b> Date:</b> {{ date('d M-Y') }} <br>
                                </div>

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-left"> Name </th>
                                        <th class="text-left"> Type </th>
                                        <th class="text-right"> Amount </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total_income = 0;
                                        $total_expense = 0;
                                    @endphp
                                    @foreach ($income_accounts as $income_account)
                                        @php
                                            $income_balance = $income_account->balance($searchData);
                                            $total_income += $income_balance;
                                        @endphp
                                        <tr>
                                            <td class="text-left">{{ $income_account->name ?? '' }}</td>
                                            <td class="text-left"> Income </td>
                                            <td class="text-right">
                                                {{ number_format($income_balance, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach ($expense_accounts as $expense_account)
                                        @php
                                            $expense_balance = $expense_account->balance($searchData);
                                            $total_expense += $expense_balance;
                                        @endphp
                                        <tr>
                                            <td class="text-left">{{ $expense_account->name ?? '' }}</td>
                                            <td class="text-left"> Expense </td>
                                            <td class="text-right">
                                                {{ number_format($expense_balance, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($pos)
                                        @php
                                            $total_expense += $pos['sale_tax'];
                                            $total_expense += $pos['sale_vat'];
                                        @endphp
                                        <tr>
                                            <td class="text-left"> Sale Tax </td>
                                            <td class="text-left"> Expense </td>
                                            <td class="text-right">
                                                {{ number_format($pos['sale_tax'], 2) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-left"> Sale Vat </td>
                                            <td class="text-left"> Expense </td>
                                            <td class="text-right">
                                                {{ number_format($pos['sale_vat'], 2) }}
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th class="text-right" colspan="2"> Net Profit / Loss </th>
                                        <th class="text-right">{{ number_format($total_income - $total_expense, 2) }}
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
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
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script>
        $(function() {
            $('.select2').select2();
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            });
        })

        $('body').on('change', '#section_id', function() {
            var section_id = $('#section_id').val();
            var options = '<option value=""> All branch </option>';
            var selected = '{{ request()->get('company_branch_id') }}';
            $.ajax({
                method: "GET",
                url: "{{ route('get_section_branch') }}",
                data: {
                    'section_id': section_id
                },
            }).done(function(response) {
                // console.log(response);
                response.forEach(function(item, i) {
                    if (selected == item.id) {
                        options += '<option selected value="' + item.id + '"> ' + item.name +
                            ' </option>';
                    } else {
                        options += '<option value="' + item.id + '"> ' + item.name + ' </option>';
                    }
                });
                $('#company_branch_id').html(options);
            });
        })
        $('#section_id').trigger('change');

        function getprint(prinarea) {
            $("div").removeClass("table-responsive");
            $('body').html($('#' + prinarea).html());
            window.print();
            window.location.replace('{!! url()->full() !!}')
        }
    </script>
@endsection