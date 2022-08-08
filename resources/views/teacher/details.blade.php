@extends('layouts.app')
@section('teacher', 'active menu-open')
@section('teacher_manage', 'active')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <style>
        .billing_box {
            padding: 5px 10px;
            border: 2px solid #cccccc;
            display: inline-block;
            margin: 5px 0px;
        }

        .table th {
            padding: 4px 5px !important;
            vertical-align: middle;
        }

        .table td {
            padding: 3px 5px !important;
            vertical-align: middle;
        }
    </style>
@endsection

@section('title')
    Teacher Details
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <a role="button" class="btn btn-primary" onclick="getPrint()">Print</a>
                        </div>
                    </div>

                    <hr>
                    <div id="print_area">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="text-center teacher_photo">
                                            <img src="{{ $teacher->photo ? url($teacher->photo) : url('public/img/no_image.png') }}"
                                                alt="Photo" height="80" width="80">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-9">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="100"> Name </th>
                                                <td> {{ $teacher->name }} </td>
                                            </tr>
                                            <tr>
                                                <th> Mobile no. </th>
                                                <td> {{ $teacher->mobile_no }} </td>
                                            </tr>
                                            <tr>
                                                <th> Branch </th>
                                                <td> {{ $teacher->companyBranch->name ?? '' }} </td>
                                            </tr>
                                            <tr>
                                                <th> Designation </th>
                                                <td> {{ $teacher->designation->name ?? '' }} </td>
                                            </tr>
                                            <tr>
                                                <th> Gender </th>
                                                <td> {{ $teacher->gender }} </td>
                                            </tr>
                                            <tr>
                                                <th> Education </th>
                                                <td> {{ $teacher->education }} </td>
                                            </tr>
                                            <tr>
                                                <th> Address </th>
                                                <td> {{ $teacher->address }} </td>
                                            </tr>
                                            <tr>
                                                <th> Short bio </th>
                                                <td> {{ $teacher->short_bio }} </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}">
    </script>

    <script>
        $(function() {
            //
        });

        function getPrint() {
            var html = $('body').html($('#print_area').html());
            window.print(html);
            window.location.replace('{!! url()->full() !!}');
        }
    </script>
@endsection
