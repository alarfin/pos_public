@extends('layouts.app')
@section('student_attendances', 'active menu-open')
@section('student_attendance', 'display: block')
@section('student_attendance_manage', 'active')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Student Attendance List
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
                    <a class="btn btn-primary" href="{{ route('student_attendance_add') }}">Add Attendance </a>

                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"> Sl. </th>
                                <th> Date </th>
                                <th> ID No. </th>
                                <th> Student </th>
                                <th> Branch </th>
                                <th> Batch </th>
                                <th> Present </th>
                                <th> In Time</th>
                                <th> Out Time </th>
                                <th> Late </th>
                                <th> Note </th>
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
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfmake.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfMake.vfs.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/datatable.js') }}">
    </script>

    <script>
        $(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                ajax: {
                    url: '{{ route('student_attendance_datatable') }}',
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
                        data: 'student.id_no',
                        name: 'student.name',
                        orderable: false
                    },
                    {
                        data: 'student_name',
                        name: 'student.name',
                        orderable: false
                    },
                    {
                        data: 'branch_name',
                        name: 'company_branch.name',
                        orderable: false
                    },
                    {
                        data: 'batch_name',
                        name: 'batch.name',
                        orderable: false
                    },
                    {
                        data: 'present',
                        name: 'present',
                        orderable: false
                    },
                    {
                        data: 'in_time',
                        name: 'in_time'
                    },
                    {
                        data: 'out_time',
                        name: 'out_time'
                    },
                    {
                        data: 'late',
                        name: 'late'
                    },
                    {
                        data: 'note',
                        name: 'note'
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
                        className: "text-center",
                        "targets": [6]
                    },
                    {
                        className: "text-center",
                        "targets": [9]
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
            });
        })
    </script>
@endsection
