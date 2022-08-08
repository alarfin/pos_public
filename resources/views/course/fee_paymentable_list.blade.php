@extends('layouts.app')
@section('online_information', 'active menu-open')
@section('fee_paymentable_list', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
@endsection

@section('title')
    Fee payable list
@endsection

@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">SL.</th>
                                <th class="text-left">Date</th>
                                <th class="text-left">Serial no.</th>
                                <th class="text-left">Customer</th>
                                <th class="text-left">Mobile</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">Paid</th>
                                <th class="text-right">Due </th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-pay">
        <div class="modal-dialog">
            <form id="modal-form" enctype="multipart/form-data" name="modal-form">
                @csrf
                <input type="hidden" name="online_information_id" id="online_information_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Payment Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Name</label>
                                <input class="form-control" id="modal-name" disabled>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Date</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control pull-right" id="date" name="date"
                                        value="{{ date('Y-m-d') }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label> Online Payment type </label>
                                <select class="form-control select2" id="modal-online_payment_type_id"
                                    name="online_payment_type_id">
                                    <option value=""> Select payment type </option>
                                    @foreach ($online_payment_types as $online_payment_type)
                                        <option value="{{ $online_payment_type->id }}"> {{ $online_payment_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Payment Method</label>
                                <select class="form-control select2" id="modal-payment-method" name="payment_method">
                                    <option value="1">Cash In Hand </option>
                                    <option value="2">Bank</option>
                                </select>
                            </div>

                            <div id="modal-bank-info">
                                <div class="form-group col-md-6">
                                    <label>Bank Account</label>
                                    <select class="form-control select2 modal-bank" name="bank">
                                        <option value="">Select Bank </option>

                                        @foreach ($banks as $bank)
                                            <option value="{{ $bank->id }}"> {{ $bank->account_no }}
                                                {{ $bank->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label> Fee Amount </label>
                                <input class="form-control" name="fee_payment_paid" value="0" id="modal-amount"
                                    placeholder="Enter Fee Amount">
                            </div>

                            <div class="form-group col-md-6">
                                <label> User </label>
                                <input type="text" class="form-control" name="user" id="modal-user"
                                    placeholder="Enter user">
                            </div>
                            <div class="form-group col-md-6">
                                <label> Pin </label>
                                <input type="text" class="form-control" name="pin" id="modal-pin"
                                    placeholder="Enter pin">
                            </div>
                            <div class="form-group col-md-6">
                                <label> Password </label>
                                <input type="text" class="form-control" name="password" id="modal-password"
                                    placeholder="Enter password">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Note</label>
                                <input class="form-control" name="fee_payment_note" placeholder="Enter Note">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary pull-left" id="modal-btn-pay">Pay</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfmake.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfMake.vfs.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/datatable.js') }}">
    </script>
    <!-- bootstrap datepicker -->
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <!-- sweet alert 2 -->
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

            // Datatable
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                // "ordering": false,
                ajax: {
                    url: '{{ route('fee_paymentable_datatable') }}',
                    data: function(d) {
                        d.test = '1'
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'serial_no',
                        name: 'serial_no'
                    },
                    {
                        data: 'customer_name',
                        name: 'customer.name',
                        orderable: false,
                    },
                    {
                        data: 'customer_mobile_no',
                        name: 'customer.mobile_no',
                        orderable: false,
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'paid',
                        name: 'paid'
                    },
                    {
                        data: 'due',
                        name: 'due'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                "columnDefs": [{
                        className: "text-center",
                        "targets": [0]
                    },
                    {
                        className: "text-left",
                        "targets": [1]
                    },
                    {
                        className: "text-right",
                        "targets": [5]
                    },
                    {
                        className: "text-right",
                        "targets": [6]
                    },
                    {
                        className: "text-right",
                        "targets": [7]
                    },
                ],
                dom: 'Bfrtip',
                buttons: [
                    'pageLength',
                    'colvis',
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ],
                order: [
                    [1, "desc"]
                ],
            });
        });

        // Payment Method
        $('#modal-payment-method').change(function() {
            if ($(this).val() == '2') {
                $('#modal-bank-info').show();
            } else {
                $("#bank_id option:selected").prop("selected", false);
                $('#modal-bank-info').hide();
            }
        });
        $('#modal-payment-method').trigger('change');

        $('body').on('click', '.btn-pay', function() {
            $('#modal-order-info').hide();
            $('#online_information_id').val($(this).data('id'));
            $('#modal-name').val($(this).data('name'));
            // $('#modal-amount').val($(this).data('amount'));
            $('#modal-pay').modal('show');
        });

        $('#modal-btn-pay').click(function() {
            var formData = new FormData($('#modal-form')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('online_information_fee_payment') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $('#modal-pay').modal('hide');
                        Swal.fire(
                            'Paid!',
                            response.message,
                            'success'
                        ).then((result) => {
                            $('#table').DataTable().ajax.reload();
                            // location.reload();
                            // window.location.href = response.redirect_url;
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
        });
    </script>
@endsection
