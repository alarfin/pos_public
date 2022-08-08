@extends('layouts.app')
@section('student_attendances', 'active menu-open')
@section('student_attendance', 'display: block')
@section('student_attendance_add', 'active')
@section('title')
    Student attendance add
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/timepicker/bootstrap-timepicker.min.css') }}">
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
                <div class="box-header with-border">
                    <h3 class="box-title"> Student attendance information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="GET" action="{{ route('student_attendance_add') }}">
                    {{-- @csrf --}}

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    {{-- <label class="col-sm-12"> Company Branch *</label> --}}
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="company_branch_id" id="company_branch_id"
                                            required>
                                            <option value="" disabled selected> Select company branch </option>
                                            @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('company_branch_id', $selectedBranch) == $branch->id) selected @endif>{{ $branch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('company_branch_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('batch') ? 'has-error' : '' }}">
                                    {{-- <label class="col-sm-12"> Company Branch *</label> --}}
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="batch" id="batch" required>
                                            <option value="" disabled selected> Select company branch </option>
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}"
                                                    @if (old('batch', $selectedBatch) == $batch->id) selected @endif>{{ $batch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('batch')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <div class="col-sm-12">
                                        <input type="text" name="date" class="form-control date"
                                            value="{{ date('Y-m-d', strtotime($date)) }}" required autocomplete="off">
                                        @error('date')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('date') ? 'has-error' : '' }}">
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary"> Search </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if (count($students) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body table-responsive">

                        <form action="{{ route('student_attendance_add') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ old('date', $date) }}" name="date" class="form-control"
                                autocomplete="off">
                            <table id="table" class="table table-bordered table-striped ">
                                <thead>
                                    <tr>
                                        <h5>
                                            <input value="1" id="check_all" name="check_all" type="checkbox"> <label
                                                for="check_all">Check All</label>
                                            </h4>
                                    </tr>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th> Mobile no </th>
                                        <th>Present</th>
                                        <th width=""> Present Time </th>
                                        <th width="">Out Time </th>
                                        <th width="">Late</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        @php
                                            $attendance = $student->attendance($date);
                                        @endphp
                                        {{-- {{ dd($attendance) }} --}}
                                        <span class="item">
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->mobile_no }}</td>
                                                <td>
                                                    <input value="1" class="present_check"
                                                        name="present_{{ $student->id }}"
                                                        @if (!empty($attendance) && $attendance->present == 1) checked @endif type="checkbox">
                                                </td>
                                                <td>
                                                    <input class="timepicker in_time" name="in_time_{{ $student->id }}"
                                                        value="@if (!empty($attendance) && $attendance->in_time) {{ $attendance->in_time }} @endif"
                                                        type="text">
                                                </td>
                                                <td>
                                                    <input class="timepicker out_time" name="out_time_{{ $student->id }}"
                                                        value="@if (!empty($attendance) && $attendance->out_time) {{ $attendance->out_time }} @endif"
                                                        type="text">
                                                </td>
                                                <td>
                                                    <input value="1" class="late_check"
                                                        name="late_{{ $student->id }}"
                                                        @if (!empty($attendance) && $attendance->late == 1) checked @endif type="checkbox">
                                                </td>
                                                <td>
                                                    <input name="note_{{ $student->id }}" placeholder="Note"
                                                        value="@if (!empty($attendance) && $attendance->note) {{ $attendance->note }} @endif"
                                                        type="text">
                                                </td>
                                            </tr>
                                        </span>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>
                                            <button class="btn btn-primary form-control">Submit</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endsection
@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script
        src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script src="{{ asset('themes/backend/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
    <script>
        $(function() {
            // Select2
            $('.select2').select2();
            // Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });

            //Timepicker
            $('.timepicker').timepicker({
                showInputs: false,
                defaultTime: null
            });

            $("#check_all").change(function() {
                var check = $(this);
                if ($(this).prop('checked')) {
                    $('.present_check').prop('checked', true);
                    $(".present_check").trigger("change");
                } else {
                    $('.present_check').prop('checked', false);
                    $(".present_check").trigger("change");
                }
            });

            $(".present_check").change(function() {
                var check = $(this);
                if ($(this).prop('checked')) {
                    check.closest('tr').find('.in_time').prop("disabled", false);
                    check.closest('tr').find('.out_time').prop("disabled", false);
                } else {
                    check.closest('tr').find('.in_time').prop("disabled", true).val(' ');
                    check.closest('tr').find('.out_time').prop("disabled", true).val(' ');

                }
            });
            $(".present_check").trigger("change");
        })
    </script>
@endsection
