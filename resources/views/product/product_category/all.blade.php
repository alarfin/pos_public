@extends('layouts.app')
@section('product', 'active menu-open')
@section('product_categories', 'active')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Product Category
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
                    <a class="btn btn-primary" href="{{ route('product_category_add') }}">Add Product Category </a>
                    <hr>
                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Serial</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($product_categories as $product_category)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $product_category->name }}</td>
                                    <td>{{ $product_category->description }}</td>
                                    <td>
                                        @if ($product_category->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{ route('product_category_edit', ['product_category' => $product_category->id]) }}">Edit</a>
                                        <a class="btn btn-danger btn-sm" href="{{ route('product_category_delete', ['product_category' => $product_category->id]) }}" onclick="return confirm('Do you want to delete ?')"> Delete</a>
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
        $(function () {
            $('#table').DataTable();
        })
    </script>
@endsection
