@extends('layouts.app')
@section('online_information', 'active menu-open')
@section('online_information_manage', 'active')

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
    Online Information Details
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
                            <div class="col-xs-8">
                                <div>
                                    <img src="{{ url('storage/app/' . $setting->logo) }}" alt="Logo" height="50">
                                </div>
                                <div class="company_info">
                                    {{ $setting->address }} <br>
                                    <b>Mobile:</b> {{ $setting->mobile_no }} <br>
                                    <b>Email:</b> {{ $setting->email }} <br>
                                    <b>Web:</b> {{ $setting->web }} <br>
                                </div>
                            </div>

                            <div class="col-xs-4">
                                <div>
                                    <h3> Online information </h3>
                                    <b>Serial no:</b> {{ $online_information->serial_no }} <br>
                                    <b> Date:</b> {{ $online_information->date->format('d-m-Y') }} <br>
                                </div>
                                <div class="customer_info">
                                    <b>{{ $online_information->customer->name ?? '' }}</b> <br>
                                    Mobile: {{ $online_information->customer->mobile_no ?? '' }}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th width="150"> Name </th>
                                        <td> {{ $online_information->name }} </td>
                                    </tr>
                                    <tr>
                                        <th width="150"> Mobile number </th>
                                        <td> {{ $online_information->mobile_no }} </td>
                                    </tr>
                                    <tr>
                                        <th width="150"> NID number </th>
                                        <td> {{ $online_information->nid_no }} </td>
                                    </tr>
                                    <tr>
                                        <th width="150"> Payment Method </th>
                                        <td>
                                            @if ($online_information->payment_method == 1)
                                                Cash In Hand
                                            @elseif($online_information->payment_method == 2)
                                                Bank
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($online_information->payment_method == 2)
                                        <tr>
                                            <th width="150"> Bank Info </th>
                                            <td> {{ $online_information->bank->name ?? '' }} </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <th width="150"> Note </th>
                                        <td> {{ $online_information->note }} </td>
                                    </tr>
                                    @if ($online_information->fee_payment == 1)
                                        <tr>
                                            <th width="150"> Fee paid amount </th>
                                            <td> {{ $online_information->fee_payment_paid }} </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Fee payment type </th>
                                            <td> {{ $online_information->onlinePaymentType->name ?? '' }} </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Fee payment date </th>
                                            <td> {{ $online_information->fee_payment_date }} </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> User </th>
                                            <td> {{ $online_information->user }} </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> PIN </th>
                                            <td> {{ $online_information->pin }} </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Password </th>
                                            <td> {{ $online_information->password }} </td>
                                        </tr>
                                        <tr>
                                            <th width="150"> Fee payment note </th>
                                            <td> {{ $online_information->fee_payment_note }} </td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-offset-8 col-xs-4">
                                <table class="table table-bordered">
                                    <tr>
                                        <th class="text-right">Total Amount</th>
                                        <td class="text-right">
                                            {{ number_format($online_information->total, 2) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"> Paid </th>
                                        <td class="text-right">{{ number_format($online_information->paid, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-right"> Due Amount </th>
                                        <td class="text-right">{{ number_format($online_information->due, 2) }}</td>
                                    </tr>
                                </table>
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
