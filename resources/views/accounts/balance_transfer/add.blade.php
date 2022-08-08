@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('balance_transfer', 'display: block')
@section('balance_transfer_add', 'active')

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
    Balance Transfer Transaction
@endsection

@section('content')
    <div class="row">
        <!-- form start -->
        <form method="POST" action="{{ route('balance_transfer_add') }}">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Balance Transfer Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label> Company Branch <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="company_branch_id" id="company_branch_id" class="form-control select2"
                                            required>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('company_branch_id') == $branch->id) selected @endif> {{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('company_branch_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('transfer_no') ? 'has-error' : '' }}">
                                    <label> Transfer no <span class="text-danger">*</span> </label>

                                    <div class="">
                                        <input type="text" readonly class="form-control" id="transfer_no"
                                            name="transfer_no" value="{{ old('transfer_no', $transfer_no) }}"
                                            autocomplete="off">
                                    </div>
                                    @error('transfer_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <label>Date <span class="text-danger">*</span> </label>

                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="date" name="date"
                                            value="{{ empty(old('date')) ? ($errors->has('date') ? '' : date('Y-m-d')) : old('date') }}"
                                            autocomplete="off">
                                    </div>
                                    <!-- /.input group -->

                                    @error('date')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                                    <label> Amount <span class="text-danger">*</span> </label>

                                    <div class="">
                                        <input type="text" class="form-control" id="amount" name="amount"
                                            value="{{ old('amount', 0) }}" autocomplete="off" required>
                                    </div>
                                    <!-- /.input group -->

                                    @error('amount')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                                    <label> Note </label>

                                    <div class="">
                                        <input type="text" class="form-control" id="note" name="note"
                                            value="{{ old('note') }}" autocomplete="off">
                                    </div>
                                    <!-- /.input group -->

                                    @error('note')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Debit Account </h3>
                    </div>
                    <!-- /.box-header -->
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('debit_payment_method') ? 'has-error' : '' }}">
                                    <label> Debit Account <span class="text-danger">*</span></label>

                                    <div class="">
                                        <select name="debit_payment_method" id="debit_payment_method"
                                            class="form-control select2">
                                            <option value="1" @if (old('debit_payment_method') == 1) selected @endif> Cash
                                                In
                                                Hand </option>
                                            <option value="2" @if (old('debit_payment_method') == 2) selected @endif> Bank
                                            </option>
                                            <option value="3" @if (old('debit_payment_method') == 3) selected @endif> Credit
                                            </option>
                                        </select>
                                    </div>

                                    @error('debit_payment_method')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('debit_bank_id') ? 'has-error' : '' }}"
                                    id="debit_bank" style="display: none;">
                                    <label> Select Bank <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="debit_bank_id" id="debit_bank_id" class="form-control select2">
                                            <option value=""> Select Bank </option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    @if (old('debit_bank_id') == $bank->id) selected @endif>
                                                    {{ $bank->account_no }} - {{ $bank->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('debit_bank_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Credit Account </h3>
                    </div>
                    <!-- /.box-header -->
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('credit_payment_method') ? 'has-error' : '' }}">
                                    <label> Credit Account <span class="text-danger">*</span></label>

                                    <div class="">
                                        <select name="credit_payment_method" id="credit_payment_method"
                                            class="form-control select2">
                                            <option value="1" @if (old('credit_payment_method') == 1) selected @endif> Cash
                                                In
                                                Hand </option>
                                            <option value="2" @if (old('credit_payment_method') == 2) selected @endif> Bank
                                            </option>
                                            <option value="3" @if (old('credit_payment_method') == 3) selected @endif>
                                                Credit </option>
                                        </select>
                                    </div>

                                    @error('credit_payment_method')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('credit_bank_id') ? 'has-error' : '' }}"
                                    id="credit_bank" style="display: none;">
                                    <label> Select Bank <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="credit_bank_id" id="credit_bank_id" class="form-control select2">
                                            <option value=""> Select Bank </option>
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    @if (old('credit_bank_id') == $bank->id) selected @endif>
                                                    {{ $bank->account_no }} - {{ $bank->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('credit_bank_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="col-md-12">
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
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
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
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
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('body').on('change', '#debit_payment_method', function() {
                if ($(this).val() == 2) {
                    $('#debit_bank').show();
                } else {
                    $("#debit_bank_id").val('');
                    $('#debit_bank').hide();
                }
            })
            $('#debit_payment_method').trigger('change');

            $('body').on('change', '#credit_payment_method', function() {
                if ($(this).val() == 2) {
                    $('#credit_bank').show();
                } else {
                    $("#credit_bank_id").val('');
                    $('#credit_bank').hide();
                }
            })
            $('#credit_payment_method').trigger('change');
        });
    </script>
@endsection
