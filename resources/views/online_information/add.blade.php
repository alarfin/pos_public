@extends('layouts.app')
@section('online_information', 'active menu-open')
@section('online_information_add', 'active')

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
    Online Information
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
        <form method="POST" action="{{ route('online_information_add') }}">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Online Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label> Select Branch <span class="text-danger">*</span> </label>
                                    <div class="">
                                        <select name="company_branch_id" id="company_branch_id"
                                            class="form-control select2">
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
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : '' }}">
                                    <label>
                                        Customer <span class="text-danger">*</span>
                                        <span class="btn btn-xs btn-primary" id="customer_add" style="margin-top: -10px">
                                            <i class="fa fa-plus"></i>
                                        </span>
                                    </label>
                                    <select class="form-control customer" name="customer_id" id="customer"
                                        data-placeholder="Select customer" required>
                                        <option value=""> Select customer </option>
                                        @if (old('customer_id'))
                                            <option value="{{ old('customer_id') }}" selected>
                                                {{ App\Models\Customer::find(old('customer_id'))->name ?? '' }} </option>
                                        @endif
                                    </select>

                                    @error('customer')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
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
                                    @error('date')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('serial_no') ? 'has-error' : '' }}">
                                    <label> Serial no <span class="text-danger">*</span></label>

                                    <div class="">
                                        <input type="text" readonly class="form-control" id="serial_no" name="serial_no"
                                            value="{{ old('serial_no', $serial_no) }}" autocomplete="off">
                                    </div>
                                    @error('serial_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('online_category_id') ? 'has-error' : '' }}">
                                    <label> Work category <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="online_category_id" id="online_category_id"
                                            class="form-control select2">
                                            @foreach ($online_categories as $online_category)
                                                <option value="{{ $online_category->id }}"
                                                    @if (old('online_category_id') == $online_category->id) selected @endif>
                                                    {{ $online_category->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('online_category_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('application_type_id') ? 'has-error' : '' }}">
                                    <label> Application type <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="application_type_id" id="application_type_id"
                                            class="form-control select2">
                                            @foreach ($application_types as $application_type)
                                                <option value="{{ $application_type->id }}"
                                                    @if (old('application_type_id') == $application_type->id) selected @endif>
                                                    {{ $application_type->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('application_type_id')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                                    <label> Payment Method </label>

                                    <div class="">
                                        <select name="payment_method" id="payment_method" class="form-control select2">
                                            <option value="1" @if (old('payment_method') == 1) selected @endif> Cash
                                                In
                                                Hand </option>
                                            <option value="2" @if (old('payment_method') == 2) selected @endif> Bank
                                            </option>
                                        </select>
                                    </div>

                                    @error('payment_method')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2" id="bank_part" style="display: none;">
                                <div class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
                                    <label> Select Bank <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select name="bank_id" id="bank_id" class="form-control select2">
                                            <option value="">Select bank account </option>
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
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                                    <label> Quantity <span class="text-danger">*</span></label>

                                    <div class="">
                                        <input type="text" class="form-control" id="quantity" name="quantity"
                                            value="{{ old('quantity', 0) }}" autocomplete="off">
                                    </div>
                                    @error('quantity')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('total') ? 'has-error' : '' }}">
                                    <label> Total Amount <span class="text-danger">*</span></label>

                                    <div class="">
                                        <input type="text" class="form-control" id="total" name="total"
                                            value="{{ old('total', 0) }}" autocomplete="off">
                                    </div>
                                    @error('total')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('paid') ? 'has-error' : '' }}">
                                    <label> Paid <span class="text-danger">*</span></label>

                                    <div class="">
                                        <input type="text" class="form-control" id="paid" name="paid"
                                            value="{{ old('paid', 0) }}" autocomplete="off">
                                    </div>
                                    @error('paid')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('due') ? 'has-error' : '' }}">
                                    <label for=""> Due <span class="text-danger">*</span> </label>
                                    <input type="number" step="any" value="{{ old('due', 0) }}"
                                        class="form-control" id="due" name="due" autocomplete="off" disabled
                                        required>
                                    @error('due')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('fee_payment') ? 'has-error' : '' }}">
                                    <label for=""> Fee </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="fee_payment"
                                            value="1" id="fee_payment"
                                            @if (old('fee_payment') == 1) checked @endif />
                                        <label class="form-check-label" for="fee_payment"> Fee Payment </label>
                                    </div>
                                    @error('fee_payment')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Other Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('user') ? 'has-error' : '' }}">
                                    <label> Name</label>

                                    <div class="">
                                        <input type="text" class="form-control" id="user" name="user"
                                            value="{{ old('user') }}" autocomplete="off">
                                    </div>
                                    @error('user')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                    <label> Mobile no</label>

                                    <div class="">
                                        <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                            value="{{ old('mobile_no') }}" autocomplete="off">
                                    </div>
                                    @error('mobile_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group {{ $errors->has('nid_no') ? 'has-error' : '' }}">
                                    <label> NID no</label>

                                    <div class="">
                                        <input type="text" class="form-control" id="nid_no" name="nid_no"
                                            value="{{ old('nid_no') }}" autocomplete="off">
                                    </div>
                                    @error('nid_no')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('note') ? 'has-error' : '' }}">
                                    <label> Note </label>

                                    <div class="">
                                        <input type="text" class="form-control" id="note" name="note"
                                            value="{{ old('note') }}" autocomplete="off">
                                    </div>
                                    @error('note')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modal-customer">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Customer Information</h4>
                </div>
                <div class="modal-body">
                    <form id="customer-form" enctype="multipart/form-data" name="customer-form">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label> Mobile no. <span class="text-danger">*</span> </label>
                            <input class="form-control" name="mobile_no" id="mobile_no" placeholder="Enter mobile no."
                                required>
                        </div>
                        <div class="form-group">
                            <label> Email </label>
                            <input class="form-control" name="email" id="email" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label>Address </label>
                            <input class="form-control" name="address" placeholder="Enter address">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="customer_store"> Save </button>
                </div>
            </div>
        </div>
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
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('body').on('change', '#payment_method', function() {
                if ($(this).val() == 1) {
                    $("#bank_id option:selected").prop("selected", false);
                    $('#bank_part').hide();
                } else {
                    $('#bank_part').show();
                }
            })
            $('#payment_method').trigger('change');

            $('body').on('click', '#customer_add', function() {
                $('#modal-customer').modal('show');
            });
            $('body').on('click', '#customer_store', function() {
                storeCustomer();
            });

            function storeCustomer() {
                var formData = new FormData($('#customer-form')[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('store_new_customer') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#modal-customer').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            }).then((result) => {
                                // $('#table').DataTable().ajax.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: response.message,
                            });
                        }
                    }
                });
            }

            $('body').on('change', '#total,#paid', function() {
                calculate();
            })
            $('body').on('keyup', '#total,#paid', function() {
                calculate();
            })
            $('#payment_method').trigger('change');

            function calculate() {
                var total = parseFloat($('#total').val() || 0);
                var paid = parseFloat($('#paid').val() || 0);
                var due = (total - paid);
                $('#due').val(due);
            }
        });

        $(document).ready(function() {
            $('#customer').select2({
                placeholder: 'Select customer',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_customers') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.mobile_no + '-' + item.name,
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
