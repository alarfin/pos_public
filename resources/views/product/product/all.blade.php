@extends('layouts.app')
@section('product', 'active menu-open')
@section('product_manage', 'active')

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Manage Product
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
                    <a class="btn btn-primary" href="{{ route('product_add') }}">Add Product</a>

                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Sl.</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Category</th>
                                <th>Unit</th>
                                <th>Buy Price</th>
                                <th>Sale Price</th>
                                <th>Whole Sale Price</th>
                                <th>TAX</th>
                                <th>VAT</th>
                                <th>Status</th>
                                <th width="100">Action</th>
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
                    url: '{{ route('product_datatable') }}',
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
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'product_color',
                        name: 'productColor.name'
                    },
                    {
                        data: 'product_size',
                        name: 'productSize.name'
                    },
                    {
                        data: 'product_category',
                        name: 'productCategory.name'
                    },
                    {
                        data: 'product_unit',
                        name: 'productUnit.name'
                    },
                    {
                        data: 'buy_price',
                        name: 'buy_price'
                    },
                    {
                        data: 'sale_price',
                        name: 'sale_price'
                    },
                    {
                        data: 'whole_sale_price',
                        name: 'whole_sale_price'
                    },
                    {
                        data: 'tax',
                        name: 'tax'
                    },
                    {
                        data: 'vat',
                        name: 'vat'
                    },
                    {
                        data: 'status',
                        name: 'status'
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
                }],
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
