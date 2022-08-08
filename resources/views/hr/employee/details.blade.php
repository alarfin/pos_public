@extends('layouts.app')
@section('hr', 'active menu-open')
@section('employee', 'display: block')
@section('employee_manage', 'active')

@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('title')
    Employee Details
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                    {{-- <li><a href="#salary" data-toggle="tab">Salary</a></li>
                    <li><a href="#designation_log" data-toggle="tab">Designation Log</a></li>
                    <li><a href="#leave" data-toggle="tab">Leave</a></li> --}}
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="profile">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="pull-right btn btn-primary" onclick="getprint('prinarea_profile')">Print</button>
                            </div>
                            <br><br>
                        </div>

                        <div class="row" id="prinarea_profile">
                            <div class="col-md-8">
                                <table class="table table-bordered" >
                                    <tr>
                                        <th width="150"> Branch name </th>
                                        <td>{{ $employee->companyBranch->name??'' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $employee->name }}</td>
                                    </tr>

                                    <tr>
                                        <th> ID No </th>
                                        <td>{{ $employee->id_no }}</td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $employee->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Phone No.</th>
                                        <td>{{ $employee->mobile_no }}</td>
                                    </tr>

                                    <tr>
                                        <th>Father Name</th>
                                        <td>{{ $employee->father_name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Mother Name</th>
                                        <td>{{ $employee->mother_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date of Birth</th>
                                        <td>
                                            @if ($employee->birth_date!=null)
                                                {{ $employee->birth_date->format('j F, Y') }}
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Joining Date</th>
                                        <td>
                                            @if ($employee->join_date!=null)
                                               {{ $employee->join_date->format('j F, Y') }}
                                            @endif
                                          </td>
                                    </tr>
                                    <tr>
                                        <th>Designation</th>
                                        <td>{{ $employee->designation->name??'' }} ({{ $employee->designation->short_name??'' }})</td>
                                    </tr>

                                    <tr>
                                        <th>Gender</th>
                                        <td>
                                            @if($employee->gender == 1)
                                                Male
                                            @elseif($employee->gender == 2)
                                                Female
                                            @elseif($employee->gender == 3)
                                                Others
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Marital Status</th>
                                        <td>
                                            @if($employee->marital_status == 1)
                                                Single
                                            @elseif($employee->marital_status == 2)
                                                Married
                                            @elseif($employee->marital_status == 3)
                                                Divorced
                                            @elseif($employee->marital_status == 4)
                                                Others
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Religion</th>
                                        <td>
                                            @if($employee->religion == 1)
                                                Islam
                                            @elseif($employee->religion == 2)
                                                Hinduism
                                            @elseif($employee->religion == 3)
                                                Christianity
                                            @elseif($employee->religion == 4)
                                                Buddhism
                                            @elseif($employee->religion == 5)
                                                Other
                                            @endif
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Present Address</th>
                                        <td>{{ $employee->present_address }}</td>
                                    </tr>

                                    <tr>
                                        <th>Permanent Address</th>
                                        <td>{{ $employee->permanent_address }}</td>
                                    </tr>
                                    <tr>
                                        <th>Gross Salary</th>
                                        <td>{{ number_format($employee->salary,2)}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if($employee->status == 1)
                                            <label class="label label-success">Active</label>
                                            @else
                                            <label class="label label-warning">Inactive</label>
                                            @endif
                                        </td>
                                    </tr>

                                </table>
                            </div>

                            <div class="col-md-4 text-center">
                                @if($employee->photo)
                                <img class="img-thumbnail" src="{{ $employee->photo?url('storage/app/'.$employee->photo):asset('img/no_image.png') }}" height="100"> <br><br>
                                @endif
                                @if ($employee->signature)

                                    <img class="img-thumbnail" src="{{ $employee->signature?url('storage/app/'.$employee->signature):asset('img/no_image.png') }}" height="100"> <br><br>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="salary">
                        <table>
                            <tr>

                            </tr>
                        </table>

                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="designation_log">
                        <div class="table-responsive">
                            <table class="table no-margin">

                            </table>
                        </div>
                    </div>
                    <!-- /.tab-pane -->

                    <div class="tab-pane" id="leave">

                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('script')
    <!-- DataTables -->
    <script src="{{ asset('themes/backend/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script>

        var APP_URL = '{!! url()->full()  !!}';
        function getprint(prinarea_profile) {

            $('body').html($('#'+prinarea_profile).html());
            window.print();
            window.location.replace(APP_URL)
        }
        function getprintleave(prinarea_leave) {

            $('body').html($('#'+prinarea_leave).html());
            window.print();
            window.location.replace(APP_URL)
        }
        function getprintleave(prinarea_salary) {

            $('body').html($('#'+prinarea_salary).html());
            window.print();
            window.location.replace(APP_URL)
        }

    </script>
@endsection
