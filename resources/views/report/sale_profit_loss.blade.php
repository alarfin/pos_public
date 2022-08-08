@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_sale_profit_loss', 'active')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Sale Profit Loss Report
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_sale_profit_loss') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Company Branch </label>
                                    <select class="form-control select2" name="company_branch_id" id="company_branch_id">
                                        <option value="">All branch </option>
                                        @foreach ($company_branches as $company_branch)
                                            <option value="{{ $company_branch->id }}"
                                                {{ request()->get('company_branch_id') == $company_branch->id ? 'selected' : '' }}>
                                                {{ $company_branch->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                            name="start_date"
                                            value="{{ request()->get('start_date') ? date('Y-m-d', strtotime(request()->get('start_date'))) : '' }}"
                                            autocomplete="off" required>
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
                                            name="end_date"
                                            value="{{ request()->get('end_date') ? date('Y-m-d', strtotime(request()->get('end_date'))) : '' }}"
                                            autocomplete="off" required>
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
                                    <h3> Sale Profit Loss Report</h3>
                                    <b>
                                        Date :
                                        @if (request()->get('start_date') && request()->get('end_date'))
                                            {{ date('d-m-Y', strtotime(request()->get('start_date'))) }} to
                                            {{ date('d-m-Y', strtotime(request()->get('end_date'))) }} <br>
                                        @else
                                            Full time
                                        @endif

                                    </b>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-striped datatable">
                            <tr>
                                <th> Total sale amount </th>
                                <td class="text-right"> {{ number_format($sale_amount, 2) }} </td>
                            </tr>
                            <tr>
                                <th> Total sale purchase cost </th>
                                <td class="text-right">{{ number_format($buy_amount, 2) }}</td>
                            </tr>
                            @if ($sale_tax > 0)
                                <tr>
                                    <th> Total TAX </th>
                                    <td class="text-right">{{ number_format($sale_tax, 2) }}</td>
                                </tr>
                            @endif
                            @if ($sale_vat > 0)
                                <tr>
                                    <th> Total VAT </th>
                                    <td class="text-right">{{ number_format($sale_vat, 2) }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th> Total Profit or Loss </th>
                                <th class="text-right">
                                    {{ number_format($sale_amount - $buy_amount - $sale_tax - $sale_vat, 2) }}
                                </th>
                            </tr>
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
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
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
