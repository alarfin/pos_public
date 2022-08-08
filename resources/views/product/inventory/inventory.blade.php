@extends('layouts.app')
@section('product', 'active menu-open')
@section('inventory', 'active')

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/backend/bower_components/export_datatable/datatable.css') }}" />
@endsection

@section('title')
    Product Inventory
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
                                <th class="text-center"> Sl. </th>
                                <th class="text-left"> Code </th>
                                <th class="text-left"> Name </th>
                                <th class="text-left"> Branch </th>
                                <th class="text-left"> Color </th>
                                <th class="text-left"> Size </th>
                                <th class="text-left"> Category </th>
                                <th class="text-left"> Unit </th>
                                <th class="text-right"> Stock Quantity </th>
                                <th class="text-right"> Stock Amount </th>
                                <th class="text-center"> Action </th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-barcode">
        <div class="modal-dialog">
            <form id="modal-barcode-form" action="{{ route('product_barcode_print') }}" target="_blank"
                enctype="multipart/form-data" name="modal-barcode-form">
                {{-- @csrf --}}
                <input type="hidden" name="product_id" id="product_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> Barcode Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="product_name" disabled>
                        </div>

                        <div class="form-group">
                            <label> Quantity </label>
                            <input class="form-control" name="quantity" id="quantity" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modal-btn-barcode"> Generate Barcode</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="modal-qrcode">
        <div class="modal-dialog">
            <form id="modal-qrcode-form" action="{{ route('product_qrcode_print') }}" target="_blank"
                enctype="multipart/form-data" name="modal-qrcode-form">
                {{-- @csrf --}}
                <input type="hidden" name="product_id" id="qr_product_id">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"> QR code Information</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" id="qr_product_name" disabled>
                        </div>

                        <div class="form-group">
                            <label> Quantity </label>
                            <input class="form-control" name="quantity" id="qr_quantity" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="modal-btn-qrcode"> Generate QR code</button>
                    </div>
                </div>
            </form>
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
                    url: '{{ route('inventory_datatable') }}',
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
                        data: 'branch_name',
                        name: 'company_branch.name'
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
                        data: 'product_unit',
                        name: 'product.productUnit.name',
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
                        className: "text-right",
                        "targets": [5]
                    },
                    {
                        className: "text-right",
                        "targets": [6]
                    },
                    {
                        className: "text-center",
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
