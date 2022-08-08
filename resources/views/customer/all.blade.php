@extends('layouts.app')
@section('customer', 'active menu-open')
@section('customer_manage', 'active')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}"/>
@endsection

@section('title')
    Customer
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
                    <a class="btn btn-primary" href="{{ route('customer_add') }}">Add Customer</a>

                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"> Serial  </th>
                                <th> Custoer Name </th>
                                <th> Mobile </th>
                                <th> Email </th>
                                <th> Address </th>
                                <th class="text-right"> Balance </th>
                                <th> Status </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    {{-- <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script> --}}

    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfmake.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfMake.vfs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/datatable.js') }}"></script>

    <script>
        $(function () {
            
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                "lengthMenu": [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, "All"]],
                ajax: {
                    url: '{{ route("customer_datatable") }}',
                    data: function (d) {
                        d.test = '1'
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'name', name: 'name'},
                    {data: 'mobile_no', name: 'mobile_no'},
                    {data: 'email', name: 'email'},
                    {data: 'address', name: 'address'},
                    {data: 'balance', name: 'balance'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "columnDefs": [
                    { className: "text-center", "targets": [ 0 ] },
                    { className: "text-right", "targets": [ 5 ] },
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
            });
        })
    </script>
@endsection
