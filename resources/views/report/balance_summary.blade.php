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
                                                <th class="text-left" colspan="2"> Opening Balance </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $cash_opening_balance = $cash_account->openingBalance($searchData);
                                                $bank_opening_balance = $bank_account->openingBalance($searchData);
                                                $capital_opening_balance = $capital_account->openingBalance($searchData);
                                            @endphp
                                            <tr>
                                                <td> {{ $cash_account->name }} </td>
                                                <td class="text-right">
                                                    {{ number_format($cash_opening_balance, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{ $bank_account->name }} </td>
                                                <td class="text-right">
                                                    {{ number_format($bank_opening_balance, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{ $capital_account->name }} </td>
                                                <td class="text-right">
                                                    {{ number_format($capital_opening_balance, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-right">Total </th>
                                                <th class="text-right">
                                                    {{ number_format($cash_opening_balance + $bank_opening_balance + $capital_opening_balance, 2) }}
                                                </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th> Cash In Hand </th>
                                                <td class="text-right">
                                                    {{ number_format($cash_account->credit($searchData), 2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @foreach ($banks as $bank)
                                                <tr>
                                                    <th> {{ $bank->name }} </th>
                                                    <td class="text-right">
                                                        {{ number_format($bank->creditDetails($searchData), 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th> Capital </th>
                                                <td class="text-right">
                                                    {{ number_format($capital_account->credit($searchData), 2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th> Cash In Hand </th>
                                                <td class="text-right">
                                                    {{ number_format($cash_account->debit($searchData), 2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @foreach ($banks as $bank)
                                                <tr>
                                                    <th> {{ $bank->name }} </th>
                                                    <td class="text-right">
                                                        {{ number_format($bank->debitDetails($searchData), 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th> Capital </th>
                                                <td class="text-right">
                                                    {{ number_format($capital_account->debit($searchData), 2) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-left" colspan="2"> Closing Balance </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $cash_closing_balance = $cash_account->closingBalance($searchData);
                                                $bank_closing_balance = $bank_account->closingBalance($searchData);
                                                $capital_closing_balance = $capital_account->closingBalance($searchData);
                                            @endphp
                                            <tr>
                                                <td> {{ $cash_account->name }} </td>
                                                <td class="text-right">
                                                    {{ number_format($cash_closing_balance, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{ $bank_account->name }} </td>
                                                <td class="text-right">
                                                    {{ number_format($bank_closing_balance, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{ $capital_account->name }} </td>
                                                <td class="text-right">
                                                    {{ number_format($capital_closing_balance, 2) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-right">Total </th>
                                                <th class="text-right">
                                                    {{ number_format($cash_closing_balance + $bank_closing_balance + $capital_opening_balance, 2) }}
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
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
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
            window.location.replace('{!! url()->full() !!}');
        }
    </script>
@endsection
