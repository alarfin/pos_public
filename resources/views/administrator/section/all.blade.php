@extends('layouts.app')
@section('administrator', 'active menu-open')
@section('section', 'active')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Sections 
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
                    <!-- <a class="btn btn-primary" href="{{ route('section.add') }}">Add section </a>

                    <hr> -->

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center"> Serial </th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($sections as $key => $section)
                                <tr>
                                    <td class="text-center">{{ ++$key }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>{{ $section->description }}</td>
                                    <td>
                                        @if ($section->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
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
