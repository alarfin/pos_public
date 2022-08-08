@extends('layouts.app')
@section('purchase', 'active menu-open')
@section('purchase_order_manage', 'active')

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
    Purchase Orders
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
                                <th class="text-left">Invoice no.</th>
                                <th class="text-left">Supplier</th>
                                <th class="text-left">Mobile</th>
                                <th class="text-right">TotalAmount</th>
                                <th class="text-right">Paid Amount</th>
                                <th class="text-right">Due Amount</th>
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Payment Information</h4>
                </div>
                <div class="modal-body">
                    <form id="modal-form" enctype="multipart/form-data" name="modal-form">
                        @csrf
                        <input type="hidden" name="purchase_order_id" id="purchase_order_id">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="modal-name" disabled>
                        </div>
                        <div id="modal-order-info" style="background-color: lightgrey; padding: 10px; border-radius: 3px;">
                        </div>

                        <div class="form-group">
                            <label>Payment Method</label>
                            <select class="form-control select2" id="modal-payment-method" name="payment_method">
                                <option value="1">Cash In Hand </option>
                                <option value="2">Bank</option>
                            </select>
                        </div>

                        <div id="modal-bank-info">
                            <div class="form-group">
                                <label>Bank Account</label>
                                <select class="form-control select2 modal-bank" name="bank">
                                    <option value="">Select Bank </option>

                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->id }}"> {{ $bank->account_no }} {{ $bank->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label> Amount </label>
                            <input class="form-control" name="amount" id="modal-amount" placeholder="Enter Amount">
                        </div>

                        <div class="form-group">
                            <label>Date</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="date" name="date"
                                    value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <div class="form-group">
                            <label>Note</label>
                            <input class="form-control" name="note" placeholder="Enter Note">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-btn-pay">Pay</button>
                </div>
            </div>
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
                    url: '{{ route('purchase_order_datatable') }}',
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
                        data: 'invoice_no',
                        name: 'invoice_no'
                    },
                    {
                        data: 'supplier_name',
                        name: 'supplier.name',
                        orderable: false,
                    },
                    {
                        data: 'supplier_mobile_no',
                        name: 'supplier.mobile_no',
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
                $('#modal-bank-info').hide();
            }
        });
        $('#modal-payment-method').trigger('change');

        $('body').on('click', '.btn-pay', function() {
            $('#modal-order-info').hide();
            $('#purchase_order_id').val($(this).data('id'));
            $('#modal-name').val($(this).data('name'));
            $('#modal-amount').val($(this).data('amount'));
            $('#modal-pay').modal('show');

        });

        $('#modal-btn-pay').click(function() {
            var formData = new FormData($('#modal-form')[0]);
            $.ajax({
                type: "POST",
                url: "{{ route('purchase_order_payment') }}",
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
