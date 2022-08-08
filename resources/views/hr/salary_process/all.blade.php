@extends('layouts.app')
@section('hr', 'active menu-open')
@section('salary_process', 'display: block')
@section('salary_process_manage', 'active')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}"/>
@endsection

@section('title')
    Salary Process
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
                    <a class="btn btn-primary" href="{{ route('salary_process_add') }}">Add Salary Process </a>

                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"> Sl. </th>
                                <th> Date </th>
                                <th> Salary Process No. </th>
                                <th> Branch </th>
                                <th> Month </th>
                                <th> Year </th>
                                <th> Payment Method </th>
                                <th> Total </th>
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
                    url: '{{ route("salary_process_datatable") }}',
                    data: function (d) {
                        d.test = '1'
                    }
                },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data: 'date', name: 'date'},
                    {data: 'salary_process_no', name: 'salary_process_no', orderable: false},
                    {data: 'branch_name', name: 'company_branch.name'},
                    {data: 'month', name: 'month'},
                    {data: 'year', name: 'year'},
                    {data: 'payment_method', name: 'payment_method', orderable: false},
                    {data: 'total', name: 'total'},
                    {data: 'action', name: 'action', orderable: false},
                ],
                "columnDefs": [
                    { className: "text-center", "targets": [ 0 ] },
                    { className: "text-right", "targets": [ 6 ] },
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
