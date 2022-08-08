@extends('layouts.app')
@section('student', 'active menu-open')
@section('student_manage', 'active')

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
    Student edit
@endsection

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-warning alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
        @endforeach
    @endif
    <div class="row">
        <form method="POST" action="{{ route('student_edit', ['student' => $student->id]) }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student Personal Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' : '' }}">
                                            <label> Company branch <span class="text-danger">*</span> </label>
                                            <div class="">
                                                <select name="company_branch_id" id="company_branch_id"
                                                    class="form-control select2" required>
                                                    @foreach ($company_branches as $company_branche)
                                                        <option value="{{ $company_branche->id }}"
                                                            @if (old('company_branch_id', $student->company_branch_id) == $company_branche->id) selected @endif>
                                                            {{ $company_branche->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('company_branch_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label> Student name <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name', $student->name) }}" autocomplete="off">
                                            </div>
                                            @error('name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label> Email </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $student->email) }}" autocomplete="off">
                                            </div>
                                            @error('email')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                                            <label> Mobile no. </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no"
                                                    value="{{ old('mobile_no', $student->mobile_no) }}" autocomplete="off">
                                            </div>
                                            @error('mobile_no')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('fathers_name') ? 'has-error' : '' }}">
                                            <label> Father name </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="fathers_name"
                                                    name="fathers_name"
                                                    value="{{ old('fathers_name', $student->fathers_name) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('fathers_name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('fathers_mobile_no') ? 'has-error' : '' }}">
                                            <label> Father mobile no </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="fathers_mobile_no"
                                                    name="fathers_mobile_no"
                                                    value="{{ old('fathers_mobile_no', $student->fathers_mobile_no) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('fathers_mobile_no')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('mothers_name') ? 'has-error' : '' }}">
                                            <label> Father's name </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="mothers_name"
                                                    name="mothers_name"
                                                    value="{{ old('mothers_name', $student->mothers_name) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('mothers_name')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group {{ $errors->has('mothers_mobile_no') ? 'has-error' : '' }}">
                                            <label> Mother's mobile no </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="mothers_mobile_no"
                                                    name="mothers_mobile_no"
                                                    value="{{ old('mothers_mobile_no', $student->mothers_mobile_no) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('mothers_mobile_no')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('educational_qualification') ? 'has-error' : '' }}">
                                            <label> Educational qualification </label>

                                            <div class="">
                                                <input type="text" class="form-control" id="educational_qualification"
                                                    name="educational_qualification"
                                                    value="{{ old('educational_qualification', $student->educational_qualification) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('educational_qualification')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group {{ $errors->has('present_address') ? 'has-error' : '' }}">
                                            <label> Present address </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="present_address"
                                                    name="present_address"
                                                    value="{{ old('present_address', $student->present_address) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('present_address')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div
                                            class="form-group {{ $errors->has('permanent_address') ? 'has-error' : '' }}">
                                            <label> Permanent address </label>
                                            <div class="">
                                                <input type="text" class="form-control" id="permanent_address"
                                                    name="permanent_address"
                                                    value="{{ old('permanent_address', $student->permanent_address) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('permanent_address')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                                    <label> Photo </label>
                                    <div class="">
                                        <input type="file" class="form-control" id="photo" name="photo"
                                            value="{{ old('photo') }}" autocomplete="off">
                                    </div>
                                    <div class="photo">
                                        <img id="photo_show"
                                            src="{{ url($student->photo ?? 'public/img/no_image.png') }}" alt="photo">
                                    </div>
                                    @error('photo')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('dob') ? 'has-error' : '' }}">
                                    <label> Date of birth </label>
                                    <div class="">
                                        <input type="text" class="form-control datepicker" id="dob"
                                            name="dob"
                                            value="{{ old('dob', $student->dob ? date('Y-,-d', strtotime($student->dob)) : '') }}"
                                            autocomplete="off">
                                    </div>
                                    @error('dob')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                    <label> Gender <span class="text-danger">*</span> </label>
                                    <div class="">
                                        <select name="gender" id="gender" class="form-control select2">
                                            <option value="Male" @if (old('gender', $student->gender) == 'Male') selected @endif> Male
                                            </option>
                                            <option value="Female" @if (old('gender', $student->gender) == 'Female') selected @endif>
                                                Female </option>
                                            <option value="Others" @if (old('gender', $student->gender) == 'Others') selected @endif>
                                                Others </option>
                                        </select>
                                    </div>
                                    @error('gender')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                    <label> Status <span class="text-danger">*</span></label>

                                    <div class="">
                                        <select name="status" id="status" class="form-control select2">
                                            <option value="1" @if (old('status', $student->status) == 1) selected @endif>
                                                Approved </option>
                                            <option value="0" @if (old('status', $student->status) == 0) selected @endif>
                                                Pending
                                            </option>
                                            {{-- @if ($student->status != 3)
                                                <option value="2" @if (old('status', $student->status) == 2) selected @endif>
                                                    Rejected
                                                </option>
                                            @endif --}}
                                            @if ($student->status != 2)
                                                <option value="3" @if (old('status', $student->status) == 3) selected @endif>
                                                    Completed
                                                </option>
                                            @endif
                                        </select>
                                    </div>
                                    @error('status')
                                        <span class="help-block">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Course Information</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('course_id') ? 'has-error' : '' }}">
                                            <label> Course <span class="text-danger">*</span> </label>
                                            <div class="">
                                                <select name="course_id" id="course_id" class="form-control select2"
                                                    required>
                                                    @foreach ($courses as $course)
                                                        <option value="{{ $course->id }}"
                                                            @if (old('course_id', $student->course_id) == $course->id) selected @endif>
                                                            {{ $course->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('course_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('batch_id') ? 'has-error' : '' }}">
                                            <label> Batch <span class="text-danger">*</span> </label>
                                            <div class="">
                                                <select name="batch_id" id="batch_id" class="form-control select2"
                                                    required>
                                                    @foreach ($batches as $batch)
                                                        <option value="{{ $batch->id }}"
                                                            @if (old('batch_id', $student->batch_id) == $batch->id) selected @endif>
                                                            {{ $batch->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('batch_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('payment_method') ? 'has-error' : '' }}">
                                            <label> Payment Method </label>

                                            <div class="">
                                                <select name="payment_method" id="payment_method"
                                                    class="form-control select2">
                                                    <option value="1"
                                                        @if (old('payment_method', $student->payment_method) == 1) selected @endif> Cash
                                                        In
                                                        Hand </option>
                                                    <option value="2"
                                                        @if (old('payment_method', $student->payment_method) == 2) selected @endif> Bank
                                                    </option>
                                                </select>
                                            </div>

                                            @error('payment_method')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="bank_part" style="display: none;">
                                        <div class="form-group {{ $errors->has('bank_id') ? 'has-error' : '' }}">
                                            <label> Select Bank <span class="text-danger">*</span></label>
                                            <div class="">
                                                <select name="bank_id" id="bank_id" class="form-control select2">
                                                    <option value="">Select bank account </option>
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank->id }}"
                                                            @if (old('bank_id', $student->bank_id) == $bank->id) selected @endif>
                                                            {{ $bank->account_no }} - {{ $bank->name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('bank_id')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('fee') ? 'has-error' : '' }}">
                                            <label> Course fee </label>
                                            <div class="">
                                                <input readonly type="text" class="form-control" id="fee"
                                                    name="fee" value="{{ old('fee', $student->fee) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('fee')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('certificate_fee') ? 'has-error' : '' }}">
                                            <label> Certificate fee </label>
                                            <div class="">
                                                <input type="number" step="any" readonly class="form-control"
                                                    id="certificate_fee" name="certificate_fee"
                                                    value="{{ old('certificate_fee', $student->certificate_fee) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('certificate_fee')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('discount') ? 'has-error' : '' }}">
                                            <label> Discount amount </label>
                                            <div class="">
                                                <input type="number" step="any" class="form-control" id="discount"
                                                    name="discount" value="{{ old('discount', $student->discount) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('discount')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('paid') ? 'has-error' : '' }}">
                                            <label> Paid amount </label>
                                            <div class="">
                                                <input type="text" readonly step="any" class="form-control"
                                                    id="paid" name="paid"
                                                    value="{{ old('paid', $student->paid) }}" autocomplete="off">
                                            </div>
                                            @error('paid')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group {{ $errors->has('due') ? 'has-error' : '' }}">
                                            <label> Due amount </label>
                                            <div class="">
                                                <input type="text" readonly class="form-control" id="due"
                                                    name="due" value="{{ old('due', $student->due) }}"
                                                    autocomplete="off">
                                            </div>
                                            @error('due')
                                                <span class="help-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

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
                var certificate_fee = parseFloat($('#certificate_fee').val() || 0);
                var discount = parseFloat($('#discount').val() || 0);
                var paid = parseFloat($('#paid').val() || 0);
                var due = fee + certificate_fee - discount - paid;
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
