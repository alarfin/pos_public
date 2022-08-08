@extends('layouts.app')
@section('product', 'active menu-open')
@section('product_units', 'active')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Product Unit
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
                    <a class="btn btn-primary" href="{{ route('product_unit_add') }}">Add Product Unit </a>
                    <hr>
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Serial</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($product_units as $product_unit)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $product_unit->name }}</td>
                                    <td>
                                        @if ($product_unit->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('product_unit_edit')
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('product_unit_edit', ['product_unit' => $product_unit->id]) }}">Edit</a>
                                        @endcan
                                        @can('product_unit_delete')
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ route('product_unit_delete', ['product_unit' => $product_unit->id]) }}"
                                                onclick="return confirm('Do you want to delete ?')">Delete</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>
        $(function() {
            $('#table').DataTable();
        })
    </script>
@endsection
