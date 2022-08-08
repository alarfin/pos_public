@extends('layouts.app')
@section('photocopy_cash_closing', 'active menu-open')
@section('photocopy_cash_closing_add', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Photocopy cash closing
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('photocopy_cash_closing_add') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> Company Branch </label>
                                    <select class="form-control select2" name="search_company_branch_id"
                                        id="search_company_branch_id">
                                        {{-- <option value="">All branch </option> --}}
                                        @foreach ($branches as $company_branch)
                                            <option value="{{ $company_branch->id }}"
                                                {{ $selected_company_branch->id == $company_branch->id ? 'selected' : '' }}>
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
                                        <input type="text" class="form-control pull-right datepicker" id="search_date"
                                            name="search_date" value="{{ date('Y-m-d', strtotime($search_date)) }}"
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
        <form method="POST" action="{{ route('photocopy_cash_closing_add') }}">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Photocopy Cash Closing Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label> Branch <span class="text-danger">*</span> </label>
                                    <div class="">
                                        <input readonly type="text" name="company_branch_name"
                                            value="{{ $selected_company_branch->name }}" class="form-control">
                                        <input type="hidden" name="company_branch_id"
                                            value="{{ $selected_company_branch->id }}">
                                    </div>
                                    @error('company_branch_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <label>Date <span class="text-danger">*</span></label>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input readonly type="text" class="form-control pull-right" id="date"
                                            name="date" value="{{ old('date', $search_date) }}" autocomplete="off">
                                    </div>
                                    @error('date')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                                    <label> Note </label>
                                    <div class="">
                                        <input type="text" name="note"
                                            value="{{ old('note', $photocopy_cash->note ?? '') }}" class="form-control">
                                    </div>
                                    @error('note')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <tr>
                                        <th> Entry Quantity </th>
                                        <th> Entry Amount </th>
                                        <th> Cash Entry </th>
                                        <th> Extra Amount </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" readonly value="{{ $entry_quantity }}"
                                                class="form-control entry_quantity">
                                        </td>
                                        <td>
                                            <input type="text" readonly value="{{ $entry_amount }}"
                                                class="form-control entry_amount">
                                        </td>
                                        <td>
                                            <input type="number" name="amount"
                                                value="{{ old('amount', $photocopy_cash->amount ?? 0) }}"
                                                class="form-control amount">
                                        </td>
                                        <td>
                                            <input type="text" readonly value="0"
                                                class="form-control extra_amount">
                                            <span class="extra_amount"></span>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table table-bordered">
                                    <tr>
                                        <th> Machine Closing </th>
                                        <th> Machine Copy </th>
                                        <th> Entry Quantity </th>
                                        <th> Extra Quantity </th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" readonly value="{{ $machine_closing }}"
                                                class="form-control machine_closing">
                                        </td>
                                        <td>
                                            <input type="text" readonly
                                                value="{{ $machine_closing - $machine_last_closing }}"
                                                class="form-control machine_copy">
                                        </td>
                                        <td>
                                            <input type="text" readonly value="{{ $entry_quantity }}"
                                                class="form-control entry_quantity">
                                        </td>
                                        <td>
                                            <input type="text" readonly
                                                value="{{ $machine_closing - $machine_last_closing - $entry_quantity }}"
                                                class="form-control extra_quantity">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <!-- jQuery UI -->
    <script src="{{ asset('themes/backend/js/jquery-ui.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script src="{{ asset('themes/backend/js/sweetalert2.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('body').on('change', '.amount', function() {
                calculate();
            });
            $('body').on('keyup', '.amount', function() {
                calculate();
            });
            $('.amount').trigger('change');

            function calculate() {
                var cash = parseFloat($('.amount').val() || 0);
                var entry_quantity = parseFloat($('.entry_quantity').val() || 0);
                var entry_amount = parseFloat($('.entry_amount').val() || 0);
                var extra_amount = parseFloat(cash - entry_amount);
                var machine_copy = parseFloat($('.machine_copy').val() || 0);
                var extra_quantity = parseFloat(machine_copy - entry_quantity);

                $('.extra_amount').val(extra_amount);
                $('.extra_quantity').val(extra_quantity);

            }
        });
    </script>
@endsection
