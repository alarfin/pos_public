@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('opening_balance', 'display: block')
@section('employee_opening_balance_add', 'active')

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
    Employee Opening Balance
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
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Transaction Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('opening_balance_add') }}">
                    @csrf
                    <input type="hidden" name="type" value="2">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label> Company Branch <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="company_branch_id" id="company_branch_id" class="form-control select2"
                                            onchange="getEmployee()" required>
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
                            <div class="col-md-3" id="employee_part">
                                <div class="form-group {{ $errors->has('employee') ? 'has-error' : '' }}">
                                    <label>Employee <span class="text-danger">*</span> </label>
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
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <label>Date <span class="text-danger">*</span></label>

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
                        </div>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="25%"> Account name <span class="text-danger">*</span></th>
                                        <th width="40%"> Note </th>
                                        <th> Amount <span class="text-danger">*</span> </th>
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
                                                        <select name="account_ids[]"
                                                            class="form-control select2 account_ids">
                                                            @foreach ($accounts as $account)
                                                                <option value="{{ $account->id }}"
                                                                    @if (old('account_ids.' . $loop->index) == $account->id) selected @endif>
                                                                    {{ $account->name }} </option>
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
                                                            value="{{ old('amounts.' . $loop->index, 0) }}">
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
                                                    <select name="account_ids[]" class="form-control select2 account_ids">
                                                        @foreach ($accounts as $account)
                                                            <option value="{{ $account->id }}"> {{ $account->name }}
                                                            </option>
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
                                                        name="amounts[]" value="0">
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
                                        <th colspan="2" class="text-right">Total Amount</th>
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
                    <select name="account_ids[]" class="form-control select2 account_ids">
                        @foreach ($accounts as $account)
                            <option value="{{ $account->id }}"> {{ $account->name }} </option>
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
                    <input type="number" step="any" class="form-control amounts" name="amounts[]" value="0">
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

        $(document).ready(function() {
            getEmployee();
        });

        function getEmployee() {
            $('#employee option:selected').remove();
            var company_branch_id = $('#company_branch_id').val();
            $('#employee').select2({
                placeholder: 'Select employee',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_branch_employees') }}',
                    data: {
                        company_branch_id: company_branch_id
                    },
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
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
        }
    </script>
@endsection
