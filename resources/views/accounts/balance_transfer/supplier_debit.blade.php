@extends('layouts.app')
@section('account', 'active menu-open')
@section('debit_transaction_add', 'active')

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
    Debit Transaction
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Transaction Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('debit_transaction_add') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <label>Date *</label>

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
                                <div class="form-group {{ $errors->has('transaction_no') ? 'has-error' : '' }}">
                                    <label> Transaction no *</label>

                                    <div class="">
                                        <input type="text" readonly class="form-control" id="transaction_no"
                                            name="transaction_no" value="{{ old('transaction_no', $transaction_no) }}"
                                            autocomplete="off">
                                    </div>
                                    <!-- /.input group -->

                                    @error('transaction_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                                    <label> Transaction Method (Credit) </label>

                                    <div class="">
                                        <select name="payment_method" id="payment_method" class="form-control select2">
                                            <option value="1" @if (old('payment_method') == 1) selected @endif> Cash
                                                In Hand </option>
                                            <option value="2" @if (old('payment_method') == 2) selected @endif> Bank
                                            </option>
                                            {{-- <option value="3" @if (old('payment_method') == 3) selected @endif> Credit </option> --}}
                                        </select>
                                    </div>

                                    @error('payment_method')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3" id="bank_part" style="display: none;">
                                <div class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
                                    <label> Select Bank *</label>
                                    <div class="">
                                        <select name="bank_id" id="bank_id" class="form-control select2">
                                            @foreach ($banks as $bank)
                                                <option value="{{ $bank->id }}"
                                                    @if (old('bank_id') == $bank->id) selected @endif>
                                                    {{ $bank->account_no }} - {{ $bank->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('bank_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('transaction_user_type') ? 'has-error' : '' }}">
                                    <label> Transaction User Type </label>

                                    <div class="">
                                        <select name="transaction_user_type" id="transaction_user_type"
                                            class="form-control select2">
                                            <option value=""> Select type </option>
                                            <option value="1" @if (old('transaction_user_type') == 1) selected @endif>
                                                Employee </option>
                                            <option value="2" @if (old('transaction_user_type') == 2) selected @endif>
                                                Supplier </option>
                                        </select>
                                    </div>

                                    @error('transaction_user_type')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4" id="employee_part" style="display: none">
                                <div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
                                    <label>Employee *</label>
                                    <select class="form-control employee" name="employee" id="employee"
                                        data-placeholder="Select employee" required>
                                        <option value="">Select employee </option>
                                        @if (old('employee'))
                                            <option value="{{ old('employee') }}" selected>
                                                {{ App\Models\Employee::find(old('employee'))->name ?? '' }} </option>
                                        @endif
                                    </select>

                                    @error('employee')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4" id="supplier_part" style="display: none">
                                <div class="form-group {{ $errors->has('supplier') ? 'has-error' : '' }}">
                                    <label>Supplier *</label>
                                    <select class="form-control supplier" name="supplier" id="supplier"
                                        data-placeholder="Select Supplier" required>
                                        <option value="">Select Supplier </option>
                                        @if (old('supplier'))
                                            <option value="{{ old('supplier') }}" selected>
                                                {{ App\Models\Supplier::find(old('supplier'))->name ?? '' }} </option>
                                        @endif
                                    </select>

                                    @error('supplier')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group {{ $errors->has('remark') ? 'has-error' : '' }}">
                                    <label> Remark </label>

                                    <div class="">
                                        <input type="text" class="form-control" id="remark" name="remark"
                                            value="{{ old('remark') }}" autocomplete="off">
                                    </div>
                                    <!-- /.input group -->

                                    @error('remark')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="25%"> Account name </th>
                                        <th width="40%"> Remark </th>
                                        <th> Amount </th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody id="account-container">
                                    @if (old('account_ids') != null && sizeof(old('account_ids')) > 0)
                                        @foreach (old('account_ids') as $item)
                                            <tr class="account-item">
                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('account_ids.' . $loop->index) ? 'has-error' : '' }}">
                                                        <select name="account_ids"
                                                            class="form-control select2 account_ids">
                                                            <option value=""> Select account </option>
                                                            @foreach ($account_heads as $account_head)
                                                                <optgroup label="{{ $account_head->name }}">
                                                                    @foreach ($account_head->transactionAccounts ?? [] as $account)
                                                                        <option value="{{ $account->id }}"
                                                                            @if (old('account_ids.' . $loop->index) == $account->id) selected @endif>
                                                                            - {{ $account->name }} </option>
                                                                    @endforeach
                                                                </optgroup>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('notes.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="text" class="form-control notes" name="notes[]"
                                                            value="{{ old('notes.' . $loop->index) }}">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div
                                                        class="form-group {{ $errors->has('amounts.' . $loop->index) ? 'has-error' : '' }}">
                                                        <input type="number" step="any" class="form-control amounts"
                                                            name="amounts[]"
                                                            value="{{ old('amounts.' . $loop->index) }}">
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr class="account-item">
                                            <td>
                                                <div class="form-group">
                                                    <select name="account_ids" class="form-control select2 account_ids">
                                                        <option value=""> Select account </option>
                                                        @foreach ($account_heads as $account_head)
                                                            <optgroup label="{{ $account_head->name }}">
                                                                @foreach ($account_head->transactionAccounts ?? [] as $account)
                                                                    <option value="{{ $account->id }}"> -
                                                                        {{ $account->name }} </option>
                                                                @endforeach
                                                            </optgroup>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <input type="text" class="form-control notes" name="notes[]">
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">
                                                    <input type="number" step="any" class="form-control amounts"
                                                        name="amounts[]">
                                                </div>
                                            </td>


                                            <td class="text-center">
                                                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td>
                                            <a role="button" class="btn btn-info btn-sm" id="btn-add-account"> Add
                                                Account </a>
                                        </td>
                                        <th colspan="1" class="text-right">Total Amount</th>
                                        <th id="total-amount">0.00</th>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <template id="template-account">
        <tr class="account-item">
            <td>
                <div class="form-group">
                    <select name="account_ids" class="form-control select2 account_ids">
                        <option value=""> Select account </option>
                        @foreach ($account_heads as $account_head)
                            <optgroup label="{{ $account_head->name }}">
                                @foreach ($account_head->transactionAccounts ?? [] as $account)
                                    <option value="{{ $account->id }}"> - {{ $account->name }} </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>
            </td>

            <td>
                <div class="form-group">
                    <input type="text" class="form-control notes" name="notes[]">
                </div>
            </td>
            <td>
                <div class="form-group">
                    <input type="number" step="any" class="form-control amounts" name="amounts[]">
                </div>
            </td>


            <td class="text-center">
                <a role="button" class="btn btn-danger btn-sm btn-remove">X</a>
            </td>
        </tr>
    </template>
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

            // Payment method
            $('body').on('change', '#payment_method', function() {
                if ($(this).val() == 2) {
                    $('#bank_part').show();
                } else {
                    $('#bank_part').hide();
                }
            })
            $('#payment_method').trigger('change');

            // Transaction User type
            $('body').on('change', '#transaction_user_type', function() {
                if ($(this).val() == 1) {
                    $('#employee_part').show();
                    $('#supplier_part').hide();
                } else if ($(this).val() == 2) {
                    $('#employee_part').hide();
                    $('#supplier_part').show();
                } else {
                    $('#employee_part').hide();
                    $('#supplier_part').hide();
                }
            })
            $('#transaction_user_type').trigger('change');

            // Add more account
            $('#btn-add-account').click(function() {
                var html = $('#template-account').html();
                var item = $(html);
                $('#account-container').append(item);
                $('.select2').select2();
                if ($('.account-item').length >= 1) {
                    $('.btn-remove').show();
                }
            });

            $('body').on('click', '.btn-remove', function() {
                $(this).closest('.account-item').remove();
                if ($('.account-item').length <= 1) {
                    $('.btn-remove').hide();
                }
                calculate();
            });

            $('body').on('keyup', '.amounts', function() {
                calculate();
            });

            $('body').on('change', '.amounts', function() {
                calculate();
            });

            if ($('.account-item').length <= 1) {
                $('.btn-remove').hide();
            } else {
                $('.btn-remove').show();
            }

            calculate();
        });

        function calculate() {
            var total = 0;
            $('.account-item').each(function(i, obj) {
                var amounts = parseFloat($('.amounts:eq(' + i + ')').val() || 0);
                total += amounts;
            });

            $('#total-amount').html('' + total.toFixed(2));
        }


        // Get select2 server data
        $(document).ready(function() {
            // Employee
            $('#employee').select2({
                placeholder: 'Select employee',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_employees') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            })
            //
            $('#supplier').select2({
                placeholder: 'Select Supplier',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_supplier') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            })
        });
    </script>
@endsection
