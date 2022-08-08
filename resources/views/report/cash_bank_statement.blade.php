@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_cash_bank_statement', 'active')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Cash & bank statement
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_cash_bank_statement') }}">
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
                                    <label>Start Date <span class="text-danger">*</span> </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" id="start_date"
                                            name="start_date" value="{{ old('start_date', $start_date) }}"
                                            autocomplete="off" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>End Date <span class="text-danger">*</span> </label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right datepicker" id="end_date"
                                            name="end_date" value="{{ old('end_date', $end_date) }}" autocomplete="off"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Cash or Bank </label>
                                    <select name="account_id" id="account_id" class="form-control select2">
                                        <option value=""> Cash & Banks </option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if (request()->get('account_id') == $account->id) selected @endif>
                                                {{ $account->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3" id="bank_part" style="display: none;">
                                <div class="form-group">
                                    <label> Bank </label>
                                    <select name="bank_id" id="bank_id" class="form-control select2">
                                        <option value=""> Select bank </option>
                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}"
                                                @if (request()->get('bank_id') == $bank->id) selected @endif>
                                                {{ $bank->account_no }} - {{ $bank->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                    <h3> Cash & Bank Statement</h3>
                                    @isset($show_data['section'])
                                        <b> Section : </b> {{ $show_data['section']->name ?? '' }} <br>
                                    @endisset
                                    @isset($show_data['company_branch'])
                                        <b> Branch : </b> {{ $show_data['company_branch']->name ?? '' }} <br>
                                    @endisset
                                    @isset($show_data['bank'])
                                        <b> Bank : </b> {{ $show_data['bank']->name ?? '' }} <br>
                                    @endisset

                                    <b>
                                        Date :
                                        {{ date('d-m-Y', strtotime($start_date)) }} to
                                        {{ date('d-m-Y', strtotime($start_date)) }}
                                        <br>
                                    </b>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>Sl.</th>
                                    <th> Date </th>
                                    <th> Voucher no </th>
                                    <th> Section </th>
                                    <th> Branch name </th>
                                    <th> Account name </th>
                                    <th> Particular </th>
                                    <th class="text-right"> Debit</th>
                                    <th class="text-right"> Credit </th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($transaction_logs as $transaction_log)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction_log->date->format('d-m-Y') }}</td>
                                        <td>{{ $transaction_log->voucher_no }}</td>
                                        <td>{{ $transaction_log->section->name ?? '' }}</td>
                                        <td>{{ $transaction_log->companyBranch->name ?? '' }}</td>
                                        <td>{{ $transaction_log->account->name ?? '' }}</td>
                                        <td>{{ $transaction_log->particular }}</td>
                                        <td class="text-right">
                                            {{ number_format($transaction_log->debit, 2) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($transaction_log->credit, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th colspan="7" class="text-right"> Total </th>
                                    <th class="text-right">
                                        {{ number_format($transaction_logs->sum('debit'), 2) }}
                                    </th>
                                    <th class="text-right">
                                        {{ number_format($transaction_logs->sum('credit'), 2) }}
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="7" class="text-right"> Balance </th>
                                    <th colspan="2" class="text-center">
                                        {{ number_format($transaction_logs->sum('credit') - $transaction_logs->sum('debit'), 2) }}
                                    </th>
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

            // Csah or Bank
            $('body').on('change', '#account_id', function() {
                if ($(this).val() == 4) {
                    $('#bank_part').show();
                } else {
                    $('#bank_part').hide();
                    $("#bank_id option:selected").prop("selected", false);
                }
            })
            $('#account_id').trigger('change');

            // Datatable
            $('.datatable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                "ordering": false
            });
        });

        // Get customer
        $(document).ready(function() {
            $('#customer_id').select2({
                placeholder: 'Select customer',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_customers') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        const empty_customer = {
                            id: 0,
                            name: 'Select customer',
                            mobile_no: '',
                        }
                        data.unshift(empty_customer);
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name + ' - ' + item.mobile_no,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            })
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
