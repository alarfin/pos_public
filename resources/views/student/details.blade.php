@extends('layouts.app')
@section('student', 'active menu-open')
@section('student_manage', 'active')

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

        .student_photo img {
            border: 1px solid #dddddd;
            border-radius: 100%;
        }
    </style>
@endsection

@section('title')
    Student Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xs-12 text-right">
                    <a role="button" class="btn btn-primary" onclick="getPrint()">Print</a>
                </div>
            </div>
        </div>
        <hr>
        <div id="print_area">
            <div class="col-md-12">
                <h3 class="text-center">
                    Student Information
                </h3>
            </div>
            <div class="col-xs-4">
                <div class="box">
                    <div class="box-body">
                        <div id="print_area">
                            <div class="row">
                                <div class="col-xs-12 text-center">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="text-center student_photo">
                                                <img src="{{ $student->photo ? url($student->photo) : url('public/img/no_image.png') }}"
                                                    alt="Photo" height="80" width="80">
                                                <br>
                                                <b>
                                                    ID No: {{ $student->id_no }}
                                                </b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <b>Paymant Summary</b>
                                    </div>
                                    <br>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th> Course fee </th>
                                                <td class="text-right"> {{ $student->fee }} </td>
                                            </tr>
                                            <tr>
                                                <th> Certificatte fee </th>
                                                <td class="text-right"> {{ $student->certificate_fee }} </td>
                                            </tr>
                                            <tr>
                                                <th> Discount </th>
                                                <td class="text-right"> {{ $student->discount }} </td>
                                            </tr>
                                            <tr>
                                                <th> Total </th>
                                                <td class="text-right"> <b>{{ $student->total }}</b> </td>
                                            </tr>
                                            <tr>
                                                <th> Paid </th>
                                                <td class="text-right"> {{ $student->paid }} </td>
                                            </tr>
                                            <tr>
                                                <th> Due </th>
                                                <td class="text-right"> <b>{{ $student->due }}</b> </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xs-8">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th width="150"> Name </th>
                                                <td> {{ $student->name }} </td>
                                            </tr>
                                            <tr>
                                                <th> Branch </th>
                                                <td> {{ $student->companyBranch->name ?? '' }} </td>
                                            </tr>
                                            <tr>
                                                <th> Mobile no. </th>
                                                <td> {{ $student->mobile_no }} </td>
                                            </tr>
                                            <tr>
                                                <th> Email </th>
                                                <td> {{ $student->email }} </td>
                                            </tr>
                                            <tr>
                                                <th> Father's name </th>
                                                <td> {{ $student->fathers_name }} </td>
                                            </tr>
                                            <tr>
                                                <th> Father's mobile no </th>
                                                <td> {{ $student->fathers_mobile_no }} </td>
                                            </tr>
                                            <tr>
                                                <th> Mother's name </th>
                                                <td> {{ $student->fathers_name }} </td>
                                            </tr>
                                            <tr>
                                                <th> Mother's mobile no </th>
                                                <td> {{ $student->mothers_mobile_no }} </td>
                                            </tr>
                                            <tr>
                                                <th> Gender </th>
                                                <td> {{ $student->gender }} </td>
                                            </tr>
                                            <tr>
                                                <th> Date of birth </th>
                                                <td> {{ $student->dob ? date('d F, Y', $student->dob) : '' }} </td>
                                            </tr>
                                            <tr>
                                                <th> Education </th>
                                                <td> {{ $student->educational_qualification }} </td>
                                            </tr>
                                            <tr>
                                                <th> Present address </th>
                                                <td> {{ $student->present_address }} </td>
                                            </tr>
                                            <tr>
                                                <th> Permanent address </th>
                                                <td> {{ $student->permanent_address }} </td>
                                            </tr>
                                            <tr>
                                                <th> Online Application </th>
                                                <td>
                                                    @if ($student->online_application == 1)
                                                        Yes
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th> Certificate Delivery </th>
                                                <td> {{ $student->certificate_delivered_at ? date('d F, Y', strtotime($student->certificate_delivered_at)) : '' }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <h5 class="text-center">
                                    <b>Payments of {{ $student->name }}</b>
                                </h5>
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-center">Sl</th>
                                                <th class="text-left"> Date </th>
                                                <th class="text-left"> Voucher no </th>
                                                <th class="text-left"> Branch </th>
                                                <th class="text-left"> Payment Method </th>
                                                <th class="text-right"> Amount </th>
                                            </tr>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td class="text-center"> {{ $loop->iteration }} </td>
                                                    <td class="text-left"> {{ $payment->date->format('d F, Y') }} </td>
                                                    <td class="text-left"> {{ $payment->voucher_no }} </td>
                                                    <td class="text-left"> {{ $payment->companyBranch->name ?? '' }}
                                                    </td>
                                                    <td class="text-left">
                                                        @if ($payment->payment_method == 1)
                                                            Cash In Hand
                                                        @elseif ($payment->payment_method == 2)
                                                            {{ $payment->bank->account_no ?? '' }} -
                                                            {{ $payment->bank->name ?? '' }}
                                                        @endif
                                                    </td>
                                                    <td class="text-right"> {{ number_format($payment->amount, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        {{ $payments->links() }}
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
