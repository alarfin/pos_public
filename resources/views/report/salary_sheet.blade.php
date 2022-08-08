@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_salary_sheet', 'active')
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection
@section('style')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <style>
         .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
            border: 1px solid #000 !important;
        }
    </style>
@endsection
<?php
    use SakibRahaman\DecimalToWords\DecimalToWords;
?>
@section('title')
    Salary Sheet
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_salary_sheet') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' :'' }}">
                                    <label class="col-sm-12"> Company Branch *</label>
                                    <div class="col-sm-12">
                                        <select  class="form-control select2" name="company_branch_id" id="company_branch_id" required>
                                            <option value=""  disabled selected> Select branch </option>
                                            @foreach($branches as $branch)
                                                <option value="{{$branch->id}}" @if (old('company_branch_id', request()->get('company_branch_id'))==$branch->id) selected @endif>{{$branch->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('company_branch_id')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('year') ? 'has-error' :'' }}">
                                    <label class="col-sm-12"> Year *</label>
                                    <div class="col-sm-12">
                                        <select  class="form-control select2" name="year" id="year" required>
                                            <option value=""  disabled selected> Select year </option>
                                            @foreach($years as $year)
                                                <option value="{{$year->name}}" @if (old('year', request()->get('year'))==$year->name) selected @endif>{{$year->name}} </option>
                                            @endforeach
                                        </select>
                                        @error('year')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('month') ? 'has-error' :'' }}">
                                    <label class="col-sm-12"> Month *</label>
                                    <div class="col-sm-12">
                                        <select  class="form-control select2" name="month" id="month" required>
                                            <option value=""  disabled selected> Select month </option>
                                        </select>
                                        @error('month')
                                        <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>	&nbsp;</label>

                                    <input class="btn btn-primary form-control" type="submit" value="Search">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($salary_process)
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
                        <button class="pull-right btn btn-primary" onclick="getprint('prinarea')">Print</button><br><br>
                        <div id="prinarea">
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
                                        <h3> Salary Sheet </h3>
                                        <b>For the month of
                                        @if (count($salary_process->salaryDetails) > 0)
                                            {{ date('F', strtotime(request()->get('month'))) }}-{{request()->get('year')}}
                                        @endif </b> <br>
                                        <b> Process Date:</b> {{ $salary_process->date->format('d-m-Y')}} <br>
                                    </div>
                                </div>
                            </div>
                            @isset($salary_process)
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        {{-- <tr>
                                            <th class="text-center" colspan="3"></th>
                                            <th class="text-center" class="text-center" colspan="3">Present</th>
                                            <th class="text-center" colspan="5"></th>
                                            <th class="text-center" class="text-center" colspan="2">Deduction</th>
                                            <th class="text-center" colspan="2"></th>
                                        </tr> --}}
                                        <tr>
                                            <th class="text-center">Sl</th>
                                            <th class="text-left"> ID no. </th>
                                            <th class="text-left">Employee Name</th>
                                            <th class="text-left">Designation</th>
                                            <th class="text-center"> Total Days </th>
                                            <th class="text-center">Present</th>
                                            <th class="text-center">Absent</th>
                                            <th class="text-right">Basic</th>
                                            <th class="text-right"> Total Addition </th>
                                            <th class="text-right"> Total Deduct </th>
                                            <th class="text-right"> Net Salary </th>
                                            <th class="text-center"> Signature </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($salary_process->salaryDetails??[] as $salary)
                                            <tr>
                                                <td class="text-center">{{$loop->iteration}}</td>
                                                <td class="text-left">{{$salary->employee->id_no??''}}</td>
                                                <td class="text-left">{{$salary->employee->name??''}}</td>
                                                <td class="text-left">{{$salary->employee->designation->name??''}}</td>
                                                <td class="text-center">{{$salary->month_days}}</td>
                                                <td class="text-center">{{ $salary->payble_days }}</td>
                                                <td class="text-center">{{ $salary->absent_days }}</td>
                                                <td class="text-right">{{number_format($salary->salary,2)}}</td>
                                                <td class="text-right">{{number_format($salary->others_addition,2)}}</td>
                                                <td class="text-right">{{number_format($salary->others_deduct,2)}}</td>
                                                <td class="text-right">{{number_format($salary->net_salary,2)}}</td>
                                                <td class="text-center"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <th class="text-right" colspan="7">Total</th>
                                        <th class="text-right">{{number_format($salary_process->salaryDetails->sum('salary'),2)}}</th>
                                        <th class="text-right">{{number_format($salary_process->salaryDetails->sum('others_addition'),2)}}</th>
                                        <th class="text-right"> {{number_format($salary_process->salaryDetails->sum('others_deduct'),2)}} </th>
                                        <th class="text-right">{{number_format($salary_process->salaryDetails->sum('net_salary'),2)}}</th>
                                        <th class="text-center"></th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <strong>Taka (in words): {{ DecimalToWords::convert($salary_process->salaryDetails->sum('net_salary'),'Taka', 'Poisa')}}.</strong>
                            </div>
                            @endisset

                            <div class="row">
                                <div class="col-md-12">
                                    Printed By {{Auth::user()->name}}, Printing Time: {{ date('d M-Y h:i a') }}
                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>
        </div>
    @endif
@endsection

@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function () {
            $('.select2').select2();
            $('#year').change(function () {
                var company_branch_id = $('#company_branch_id').val();
                var year = $('#year').val();
                var selected_month = '{{request()->get("month")}}';
                $('#month').html('<option value="">Select Month</option>');

                if (year != '') {
                    $.ajax({
                        method: "GET",
                        url: "{{ route('get_month_salary_sheet') }}",
                        data: { year: year, company_branch_id:company_branch_id }
                    }).done(function( response ) {
                        $.each(response, function( index, item ) {
                            if(selected_month==item.name){
                                $('#month').append('<option selected value="'+item.name+'">'+item.full_name+'</option>');
                            }else{
                                $('#month').append('<option value="'+item.name+'">'+item.full_name+'</option>');
                            }

                        });
                    });

                }
            });
            $('#year').trigger('change');

        });
    </script>
    <script>


        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea) {
            $("div").removeClass("table-responsive");
            $('body').html($('#'+prinarea).html());
            window.print();
            window.location.replace(APP_URL)
        }
    </script>
@endsection
