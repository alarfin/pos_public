@extends('layouts.app')
@section('product', 'active menu-open')
@section('inventory_details', 'active')

@section('style')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Product Inventory Details
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
                                <label> Start Date</label>

                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="start_date" autocomplete="off">
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
                                    <input type="text" class="form-control" id="end_date" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Type</label>

                                <select class="form-control select2" id="type">
                                    <option value="">All Type</option>
                                    <option value="1">In</option>
                                    <option value="2">Out</option>
                                </select>
                            </div>
                        </div>
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
                                <label> Product </label>
                                <select class="form-control select2" id="product_id">
                                    <option value=""> Select Product </option>
                                </select>
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
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"> Sl. </th>
                                <th class="text-left"> Date </th>
                                <th class="text-left"> Code </th>
                                <th class="text-left"> Name </th>
                                <th class="text-left"> Branch </th>
                                <th class="text-left"> Color </th>
                                <th class="text-left"> Size </th>
                                <th class="text-left"> Category </th>
                                <th class="text-left"> Type </th>
                                <th class="text-left"> Note </th>
                                <th class="text-right"> Quantity </th>
                                <th class="text-right"> Amount </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <!-- Datatable  -->
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfmake.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/pdfMake.vfs.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('themes/backend/bower_components/export_datatable/datatable.js') }}">
    </script>

    <script>
        $(function() {
            // Select2
            $('.select2').select2();
            //Date picker
            $('#start_date, #end_date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
            // Datatble
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                "lengthMenu": [
                    [10, 25, 50, 100, 200, -1],
                    [10, 25, 50, 100, 200, "All"]
                ],
                ajax: {
                    url: '{{ route('inventory_details_datatable') }}',
                    data: function(d) {
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.type = $('#type').val();
                        d.product_id = $('#product_id').val();
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
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'product',
                        name: 'product.name'
                    },
                    {
                        data: 'branch_name',
                        name: 'company_branch.name'
                    }, {
                        data: 'product_color',
                        name: 'product.productColor.name',
                        orderable: false
                    },
                    {
                        data: 'product_size',
                        name: 'product.productSize.name',
                        orderable: false
                    },
                    {
                        data: 'product_category',
                        name: 'productCategory.name',
                        orderable: false
                    },
                    {
                        data: 'type',
                        name: 'type',
                        orderable: false
                    },
                    {
                        data: 'note',
                        name: 'note',
                        orderable: false
                    },
                    {
                        data: 'quantity',
                        name: 'quantity',
                        orderable: false
                    },
                    {
                        data: 'total',
                        name: 'total',
                        orderable: false
                    },
                ],
                "columnDefs": [{
                        className: "text-center",
                        "targets": [0]
                    },
                    {
                        className: "text-right",
                        "targets": [8]
                    },
                    {
                        className: "text-right",
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

            // Filter request
            $('#start_date, #end_date, #type, #company_branch_id,#product_id').change(function() {
                $('#table').DataTable().ajax.reload();
            });
        })

        $(document).ready(function() {
            $('#product_id').select2({
                placeholder: 'Select Product',
                minimumInputLength: 0,
                ajax: {
                    url: '{{ route('get_products') }}',
                    dataType: 'json',
                    delay: 100,
                    processResults: function(data) {
                        // console.log(data);
                        data.unshift({
                            id: '0',
                            name: 'Select Product',
                            code: '',
                        });
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    text: item.code + '-' + item.name,
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
