@extends('layouts.app')
@section('student', 'active menu-open')
@section('student_result_add', 'active')

@section('style')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
        href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <style>
        .photo {

            text-align: center;
            align-items: center;
        }

        .photo img {
            border: 1px solid #dddddd;
            border-radius: 3px;
            padding: 2px;
            margin: 2px 0px;
            width: 150px;
            height: 150px;
        }
    </style>
@endsection

@section('title')
    Student results
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <form action="{{ route('student_result_add') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Company Branch <span class="text-danger">*</span> </label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="company_branch_id" id="company_branch_id"
                                            required>
                                            <option value=""> Select branch </option>
                                            @foreach ($company_branches as $company_branch)
                                                <option value="{{ $company_branch->id }}"
                                                    @if (old('company_branch_id', request()->get('company_branch_id')) == $company_branch->id) selected @endif>
                                                    {{ $company_branch->name }}
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
                                <div class="form-group {{ $errors->has('course_id') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Course <span class="text-danger">*</span> </label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="course_id" id="course_id" required>
                                            <option value=""> Select course </option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}"
                                                    @if (old('course_id', request()->get('course_id')) == $course->id) selected @endif>
                                                    {{ $course->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('course_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group {{ $errors->has('batch_id') ? 'has-error' : '' }}">
                                    <label class="col-sm-12"> Batch <span class="text-danger">*</span> </label>
                                    <div class="col-sm-12">
                                        <select class="form-control select2" name="batch_id" id="batch_id" required>
                                            <option value=""> Select batch </option>
                                            @foreach ($batches as $batch)
                                                <option value="{{ $batch->id }}"
                                                    @if (old('batch_id', request()->get('batch_id')) == $batch->id) selected @endif>
                                                    {{ $batch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('batch_id')
                                            <span class="help-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label> &nbsp;</label>

                                    <input class="btn btn-primary form-control" type="submit" value="Search">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if (count($students) > 0)
        <div class="row">
            <form method="POST" action="{{ route('student_result_add') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="company_branch_id" value="{{ request()->get('company_branch_id') }}">
                <input type="hidden" name="course_id" value="{{ request()->get('course_id') }}">
                <input type="hidden" name="batch_id" value="{{ request()->get('batch_id') }}">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Student Information</h3>
                        </div>
                        <div class="box-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th class="text-center">Sl.</th>
                                    <th class="text-center">ID no.</th>
                                    <th class="text-left"> Name </th>
                                    <th class="text-left"> Mobile no. </th>
                                    <th class="text-left"> Result </th>
                                </tr>
                                @foreach ($students as $student)
                                    <input type="hidden" name="student_ids[]" value="{{ $student->id }}">
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $student->id_no }}</td>
                                        <td class="text-left">{{ $student->name }}</td>
                                        <td class="text-left">{{ $student->mobile_no }}</td>
                                        <td class="text-left">
                                            <input type="text" name="results[]"
                                                value="{{ $student->filterResult->result ?? 0 }}" class="form-control">
                                        </td>
                                    </tr>
                                @endforeach
                            </table>


                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif


@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- sweet alert 2 -->
    <!-- jQuery UI -->
    <script src="{{ asset('themes/backend/js/jquery-ui.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}">
    </script>
    <script src="{{ asset('themes/backend/js/sweetalert2.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Date picker
            $('.datepicker').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd',
                todayHighlight: true
            });

            // Payment Method
            $('body').on('change', '#payment_method', function() {
                if ($(this).val() == 1) {
                    $("#bank_id option:selected").prop("selected", false);
                    $('#bank_part').hide();
                } else {
                    $('#bank_part').show();
                }
            })
            $('#payment_method').trigger('change');

            // get course details
            $('body').on('change', '#course_id', function() {
                var course_id = $('#course_id').val();
                $.ajax({
                    method: "GET",
                    url: "{{ route('get_course_details') }}",
                    data: {
                        'course_id': course_id
                    },
                }).done(function(response) {
                    // console.log(response);
                    $('#fee').val(response.fee);
                    calculation();
                });
            })
            $('#course_id').trigger('change');

            $('body').on('keyup', '#discount, #paid', function() {
                calculation();
            });
            $('body').on('change', '#discount, #paid', function() {
                calculation();
            });

            function calculation() {
                var fee = parseFloat($('#fee').val() || 0);
                var discount = parseFloat($('#discount').val() || 0);
                var paid = parseFloat($('#paid').val() || 0);
                var due = fee - discount - paid;
                $('#due').val(due);
            }
        });

        $(document).ready(function() {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#photo_show').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#photo").change(function() {
                readURL(this);
            });
        });
    </script>
@endsection
