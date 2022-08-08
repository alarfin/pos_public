@extends('layouts.app')
@section('report', 'active menu-open')
@section('report_ledger', 'active')
@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Ledger Report
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('report_ledger') }}">
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
                                            name="start_date" value="{{ old('start_date', $start_date) }}"
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
                                            name="end_date" value="{{ old('end_date', $end_date) }}" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Account </label>
                                    <select name="account_id" id="account_id" class="form-control select2">
                                        <option value=""> Select account </option>
                                        @foreach ($accounts as $account)
                                            <option value="{{ $account->id }}"
                                                @if (request()->get('account_id') == $account->id) selected @endif>
                                                {{ $account->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Supplier </label>
                                    <select name="supplier_id" id="supplier_id" class="form-control select2">
                                        <option value=""> Select supplier </option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}"
                                                @if (request()->get('supplier_id') == $supplier->id) selected @endif>
                                                {{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('customer') ? 'has-error' : '' }}">
                                    <label> Customer </label>
                                    <select class="form-control customer" name="customer_id" id="customer_id"
                                        data-placeholder="Select customer">
                                        <option value=""> Select customer </option>
                                        @if (request()->get('customer_id'))
                                            <option value="{{ request()->get('customer_id') }}" selected>
                                                {{ App\Models\Customer::find(request()->get('customer_id'))->name ?? '' }}
                                            </option>
                                        @endif
                                    </select>

                                    @error('customer')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
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
                                    <h3> Ledger Report</h3>
                                    @isset($show_data['section'])
                                        <b> Section : </b> {{ $show_data['section']->name ?? '' }} <br>
                                    @endisset
                                    @isset($show_data['company_branch'])
                                        <b> Branch : </b> {{ $show_data['company_branch']->name ?? '' }} <br>
                                    @endisset
                                    @isset($show_data['supplier'])
                                        <b> Supplier : </b> {{ $show_data['supplier']->name ?? '' }} <br>
                                    @endisset
                                    @isset($show_data['customer'])
                                        <b> Customer : </b> {{ $show_data['customer']->name ?? '' }} <br>
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
                                @foreach ($ledgers as $ledger)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ledger->date->format('d-m-Y') }}</td>
                                        <td>{{ $ledger->voucher_no }}</td>
                                        <td>{{ $ledger->section->name ?? '' }}</td>
                                        <td>{{ $ledger->companyBranch->name ?? '' }}</td>
                                        <td>{{ $ledger->account->name ?? '' }}</td>
                                        <td>{{ $ledger->particular }}</td>
                                        <td class="text-right">
                                            {{ number_format($ledger->debit, 2) }}
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($ledger->credit, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            {{-- <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total</th>
                                    <th class="text-right">{{ number_format($total_debit, 2) }}</th>
                                    <th class="text-right">{{ number_format($total_credit, 2) }}</th>
                                    <th class="text-right">{{ number_format($total_balance, 2) }}</th>
                                </tr>
                            </tfoot> --}}
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

        // Get Section
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
