@extends('layouts.app')
@section('student', 'active menu-open')
@section('pending_students', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <style>
        .photo {
            border: 1px solid #dddddd;
            border-radius: 3px;
            padding: 3px;
        }
    </style>
@endsection

@section('title')
    Pending Students
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
                <div class="box-header with-border">
                    <h3 class="box-title">Filter</h3>
                </div>
                <!-- /.box-header -->

                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Company Branch </label>
                                <select class="form-control select2" id="company_branch_id">
                                    <option value=""> All Branch </option>
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}"> {{ $branch->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Student Status </label>
                                <select class="form-control select2" id="status">
                                    <option value=""> All </option>
                                    <option value="0"> Pending </option>
                                    <option value="1"> Approved </option>
                                    <option value="2"> Rejected </option>
                                    <option value="3"> Complete </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> Start Date</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" id="start_date"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label> End Date</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control datepicker" id="end_date" autocomplete="off">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Sl.</th>
                                    <th class="text-left"> Photo </th>
                                    <th class="text-left"> ID No </th>
                                    <th class="text-left"> Name </th>
                                    <th class="text-left"> Name </th>
                                    {{-- <th class="text-left"> Mobile </th> --}}
                                    <th class="text-left"> Branch </th>
                                    <th class="text-center"> Status </th>
                                    <th class="text-right"> Total </th>
                                    <th class="text-right"> Paid </th>
                                    <th class="text-right"> Due </th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-approve">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Student Information</h4>
                </div>
                <div class="modal-body">
                    <form id="modal-form" enctype="multipart/form-data" name="modal-form">
                        @csrf
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="modal-name" disabled>
                        </div>
                        <div class="form-group">
                            <label> Course name </label>
                            <input class="form-control" id="modal-course" disabled>
                        </div>
                        <div class="form-group">
                            <label> Batch <span class="text-danger">*</span> </label>
                            <select name="batch_id" id="batch_id" class="form-control select2">
                                <option value="">Select batch</option>
                                @foreach ($batches as $batch)
                                    <option value="{{ $batch->id }}">
                                        {{ $batch->name }} ({{ $batch->batch_no }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Date <span class="text-danger">*</span> </label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="date"
                                    name="approved_at" value="{{ date('Y-m-d') }}" autocomplete="off">
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label>Note</label>
                            <input class="form-control" name="note" placeholder="Enter Note">
                        </div> --}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary pull-left" id="modal-btn-approve"> Approved </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <!-- sweet alert 2 -->
    <script src="{{ asset('themes/backend/js/sweetalert2.js') }}"></script>

    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
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
                    url: '{{ route('pending_students_datatable') }}',
                    data: function(d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.status = $('#status').val();
                        d.company_branch_id = $('#company_branch_id').val();
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        orderable: false
                    },
                    {
                        data: 'id_no',
                        name: 'id_no'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'mobile_no',
                        name: 'mobile_no'
                    },
                    {
                        data: 'company_branch.name',
                        name: 'companyBranch.name'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                        className: "text-center photo",
                        "targets": [1]
                    },
                    {
                        className: "text-right",
                        "targets": [6, 7, 8]
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
            // Filter request
            $('.datepicker, #status, #company_branch_id').change(function() {
                $('#table').DataTable().ajax.reload();
            });

            $('body').on('click', '.btn-approve', function() {
                $('#modal-order-info').hide();
                $('#student_id').val($(this).data('id'));
                $('#modal-name').val($(this).data('name'));
                $('#modal-course').val($(this).data('course'));
                $('#modal-approve').modal('show');
            });

            $('#modal-btn-approve').click(function() {
                var formData = new FormData($('#modal-form')[0]);
                $.ajax({
                    type: "POST",
                    url: "{{ route('student_approved') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            $('#modal-approve').modal('hide');
                            Swal.fire(
                                'Approved!',
                                response.message,
                                'success'
                            ).then((result) => {
                                $('#modal-approve').modal('hide');
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
        });
    </script>
@endsection