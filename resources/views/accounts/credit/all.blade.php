@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('credit_transaction', 'display: block')
@section('credit_transactions', 'active')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Credit Voucher
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <a class="btn btn-primary" href="{{ route('credit_transaction_add') }}"> Add Credit Voucher </a>
                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> SL </th>
                                <th> Date </th>
                                <th> Transaction no. </th>
                                <th> Remark </th>
                                <th> Amount </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- DataTables -->
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfMake.vfs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/datatable.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('#date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            $('#table').DataTable({
                processing: true,
                serverSide: true,
                "lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                ajax: '{{ route("credit_transaction_datatable") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'date', name: 'date'},
                    {data: 'transaction_no', name: 'transaction_no'},
                    {data: 'remark', name: 'remark', orderable: false},
                    {data: 'amount', name: 'amount', orderable: false},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "columnDefs": [
                    { className: "text-center", "targets": [ 0 ] },
                    { className: "text-right", "targets": [ 4 ] },
                ]
            });
        })
    </script>
@endsection
