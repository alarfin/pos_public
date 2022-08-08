@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_supplier', 'active')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Supplier Report
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_supplier') }}">
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
                    <div class="row">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-sm btn-info pull-right" onclick="startPrint()"> Print
                            </button>
                        </div>
                    </div>
                    <div class="print_area">
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
                                    <h3> Supplier Report</h3>
                                    <b>
                                        Date :
                                        @if (request()->get('start_date') && request()->get('end_date'))
                                            {{ date('d-m-Y', strtotime(request()->get('start_date'))) }} to
                                            {{ date('d-m-Y', strtotime(request()->get('end_date'))) }}
                                        @else
                                            Full time
                                        @endif
                                        <br>
                                    </b>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>Serial</th>
                                    <th> Supplier name </th>
                                    <th> Mobile no </th>
                                    <th class="text-right"> Debit</th>
                                    <th class="text-right"> Credit </th>
                                    <th class="text-right"> Balance </th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $total_debit = 0;
                                    $total_credit = 0;
                                    $total_balance = 0;
                                @endphp
                                @foreach ($suppliers as $supplier)
                                    @php
                                        $debit = $supplier->debit($searchData);
                                        $credit = $supplier->credit($searchData);
                                        $balance = $credit - $debit;
                                        // Total
                                        $total_debit += $debit;
                                        $total_credit += $credit;
                                        $total_balance += $balance;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->mobile_no }}</td>
                                        <td class="text-right">
                                            {{ number_format($debit, 2) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($credit, 2) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($credit - $debit, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th class="text-right">{{ number_format($total_debit, 2) }}</th>
                                    <th class="text-right">{{ number_format($total_credit, 2) }}</th>
                                    <th class="text-right">{{ number_format($total_balance, 2) }}</th>
                                </tr>
                            </tfoot>
                        </table>
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
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfmake.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfMake.vfs.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/datatable.js') }}">
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();
            $(function() {
                $('.datepicker').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                });
            });

            // Datatable
            $('.datatable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                "ordering": false
            });
        });

        // Print Option
        function startPrint() {
            $('.dataTables_length').hide();
            $('.dataTables_filter').hide();
            $('.pagination').hide();
            $('body').html($('.print_area').html());
            window.print();
            window.location.replace('{!! url()->full() !!}')
        }
    </script>
@endsection
