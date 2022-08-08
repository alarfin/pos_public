@extends('layouts.app')
@section('accounts', 'active menu-open')
@section('opening_balance', 'display: block')
@section('opening_balances', 'active')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Opening Balance
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
                    <a class="btn btn-primary" href="{{ route('opening_balance_add') }}"> Add opening balance </a>
                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> SL </th>
                                <th> Date </th>
                                <th> Voucher no </th>
                                <th> Opening Type  </th>
                                <th> Account </th>
                                <th> Note </th>
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
                ajax: '{{ route("opening_balance_datatable") }}',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'date', name: 'date'},
                    {data: 'voucher_no', name: 'transaction_no'},
                    {data: 'opening_type', name: 'opening_type', orderable: false},
                    {data: 'account.name', name: 'account.name', orderable: false},
                    {data: 'note', name: 'note', orderable: false},
                    {data: 'amount', name: 'amount', orderable: false},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "columnDefs": [
                    { className: "text-center", "targets": [ 0 ] },
                    { className: "text-right", "targets": [ 6 ] },
                ]
            });
        })
    </script>
@endsection
