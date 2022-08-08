@extends('layouts.app')
@section('product', 'active menu-open')
@section('product_transfer_manage', 'active')

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Product Transfer
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    @can('product_transfer_create')
                        <a class="btn btn-primary" href="{{ route('product_transfer_create') }}">Add Product Transfer </a>
                        <hr>
                    @endcan

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"> Sl. </th>
                                <th class="text-left"> Code </th>
                                <th class="text-left"> Name </th>
                                <th class="text-left"> Color </th>
                                <th class="text-left"> Size </th>
                                <th class="text-left"> Category </th>
                                <th class="text-left"> Source Branch </th>
                                <th class="text-left"> Target Branch </th>
                                <th class="text-right"> Quantity </th>
                                <th class="text-right"> Amount </th>
                                <th class="text-center"> Action </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Datatable  -->
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
                    url: '{{ route('product_transfer_datatable') }}',
                    data: function(d) {
                        d.test = '1';
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
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
                        name: 'product.productCategory.name',
                        orderable: false
                    },
                    {
                        data: 'source_company_branch_name',
                        name: 'sourceCompanyBranch.name'
                    },
                    {
                        data: 'target_company_branch_name',
                        name: 'targetCompanyBranch.name'
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
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    },
                ],
                "columnDefs": [{
                        className: "text-center",
                        "targets": [0, 10]
                    },
                    {
                        className: "text-right",
                        "targets": [8, 9]
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

            // Barcode
            $('body').on('click', '.btn-barcode', function() {
                $('#product_id').val($(this).data('id'));
                $('#product_name').val($(this).data('name'));
                $('#modal-barcode').modal('show');
            })
            // QR code
            $('body').on('click', '.btn-qrcode', function() {
                $('#qr_product_id').val($(this).data('id'));
                $('#qr_product_name').val($(this).data('name'));
                $('#modal-qrcode').modal('show');
            })
        })
    </script>
@endsection
