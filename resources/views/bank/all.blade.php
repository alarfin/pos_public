@extends('layouts.app')
@section('bank', 'active menu-open')
@section('bank_manage', 'active')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Bank
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
                    @can('bank_add')
                        <a class="btn btn-primary" href="{{ route('bank_add') }}">Add Bank</a>
                    @endcan
                    <hr>

                    <table id="table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Bank Name</th>
                                <th>Account Name</th>
                                <th>Account no. </th>
                                <th>Account Code </th>
                                <th> Branch </th>
                                <th class="text-right"> Balance </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($banks as $bank)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bank->name }}</td>
                                    <td>{{ $bank->account_name }}</td>
                                    <td>{{ $bank->account_no }}</td>
                                    <td>{{ $bank->account_code }}</td>
                                    <td>{{ $bank->branch }}</td>
                                    <td class="text-right">{{ number_format($bank->balance, 2) }}</td>
                                    <td>
                                        @if ($bank->status == 1)
                                            <span class="label label-success">Active</span>
                                        @else
                                            <span class="label label-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        @can('bank_edit')
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('bank_edit', ['bank' => $bank->id]) }}">Edit</a>
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
