@extends('layouts.app')
@section('hr', 'active menu-open')
@section('employee', 'display: block')
@section('employee_manage', 'active')
@section('title')
    Designation Add
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <style>
        .photo_view, .signature{
            margin: 3px;
            padding: 3px;
            border-radius: 3px;
            border: 1px solid #ddd;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Employee Information</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{ route('employee_edit', ['employee'=>$employee->id]) }}">
                    @csrf

                    <div class="box-body">
                        <div class="form-group {{ $errors->has('company_branch_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Company branch <span class="text-danger">*</span> </label>

                            <div class="col-sm-10">
                                <select   class="form-control select2" placeholder="Enter company_branch_id" name="company_branch_id"  >
                                    <option value="" selected disabled>Select company branch </option>
                                    @foreach ($branches as $branch)
                                        <option value="1" @if (old('company_branch_id', $employee->company_branch_id)==$branch->id) selected @endif> {{$branch->name}} </option>
                                    @endforeach
                                </select>
                                @error('company_branch_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Name *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name"
                                       name="name" value="{{ old('name', $employee->name) }}">
                                @error('name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('id_no') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">ID No  *</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Enter nid no"
                                       name="id_no" value="{{ old('id_no', $employee->id_no) }}" disabled>
                                @error('id_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Email *</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Email"
                                       name="email" value="{{ old('email', $employee->email) }}">
                                @error('email')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Phone No *</label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Enter phone no"
                                       name="mobile_no" value="{{ old('mobile_no', $employee->mobile_no) }}">
                                @error('mobile_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('password') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Password </label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" placeholder="Enter Password"
                                       name="password" value="" autocomplete="new-password">
                                @error('password')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('designation_id') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Designation *</label>
                            <div class="col-sm-10">
                                <select  class="form-control select2" name="designation_id">
                                    <option value=""  disabled selected> Select Designation </option>
                                    @foreach($designations as $designation)
                                        <option value="{{$designation->id}}" @if (old('designation_id', $employee->designation_id)==$designation->id) selected @endif >
                                            {{$designation->name}} - ({{$designation->short_name}})
                                        </option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('nid_no') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">NID No  </label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Enter nid no"
                                       name="nid_no" value="{{ old('nid_no', $employee->nid_no) }}" >
                                @error('nid_no')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('father_name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Father name  </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter father name"
                                       name="father_name" value="{{ old('father_name', $employee->father_name) }}" >
                                @error('father_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('mother_name') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Mother name  </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter mother name"
                                       name="mother_name" value="{{ old('mother_name', $employee->mother_name) }}" >
                                @error('mother_name')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('gender') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Gender</label>

                            <div class="col-sm-10">
                                <select   class="form-control select2" placeholder="Enter gender" name="gender"  >
                                    <option value="" selected disabled>Select gender</option>
                                    <option value="1" @if (old('gender', $employee->gender)==1) selected @endif>Male</option>
                                    <option value="2" @if (old('gender', $employee->gender)==2) selected @endif>Female</option>
                                    <option value="3" @if (old('gender', $employee->gender)==3) selected @endif>Other</option>
                                </select>
                                @error('gender')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('marital_status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Marital Status</label>

                            <div class="col-sm-10">
                                <select   class="form-control select2" placeholder="Enter marital status" name="marital_status"  >
                                    <option value="" selected disabled>Select marital status</option>
                                    <option value="1" @if (old('marital_status', $employee->marital_status)==1) selected @endif>Single</option>
                                    <option value="2" @if (old('marital_status', $employee->marital_status)==1) selected @endif>Married</option>
                                    <option value="3" @if (old('marital_status', $employee->marital_status)==1) selected @endif>Divorced</option>
                                    <option value="4" @if (old('marital_status', $employee->marital_status)==1) selected @endif>Other</option>
                                </select>
                                @error('gender')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('religion') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Religion </label>
                            <div class="col-sm-10">
                                <select   class="form-control select2" placeholder="select religion" name="religion"  >
                                    <option value="" selected disabled>Select religion</option>
                                    <option value="1" @if (old('religion', $employee->religion)==1) selected @endif>Islam</option>
                                    <option value="2" @if (old('religion', $employee->religion)==2) selected @endif>Hinduism</option>
                                    <option value="3" @if (old('religion', $employee->religion)==3) selected @endif>Christianity</option>
                                    <option value="4" @if (old('religion', $employee->religion)==4) selected @endif>Buddhism</option>
                                    <option value="5" @if (old('religion', $employee->religion)==5) selected @endif>Other</option>
                                </select>
                                @error('religion')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('birth_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Date Of Birth</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control date"
                                       name="birth_date" value="{{ old('birth_date', $employee->birth_date?$employee->birth_date->format('Y-m-d'):'') }}">
                                @error('birth_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('join_date') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Date Of Join</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control date"
                                       name="join_date" value="{{ old('join_date', $employee->join_date?$employee->join_date->format('Y-m-d'):'') }}">
                                @error('join_date')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('salary') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label"> Salary </label>

                            <div class="col-sm-10">
                                <input type="number" class="form-control" placeholder="Enter salary"
                                       name="salary" value="{{ old('salary', $employee->salary) }}">
                                @error('salary')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('permanent_address') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Permanent Address</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter permanent address"
                                       name="permanent_address" value="{{ old('permanent_address', $employee->permanent_address) }}">
                                @error('permanent_address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('present_address') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Present Address</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter present address"
                                       name="present_address" value="{{ old('present_address', $employee->present_address) }}">
                                @error('present_address')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('photo') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">photo</label>
                            <div class="col-sm-10">
                                @if ($employee->photo)
                                    <img class="photo_view" src="{{ url('storage/app/'.$employee->photo) }}" height="80" alt="{{ $employee->name }}">
                                @endif

                                <input type="file" class="form-control-file"
                                       name="photo" value="{{ old('photo') }}">
                                @error('photo')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('signature') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Signature</label>
                            <div class="col-sm-10">
                                @if ($employee->signature)
                                    <img class="signature_view" src="{{ url('storage/app/'.$employee->signature) }}" height="80" alt="{{ $employee->name }}">
                                @endif
                                <input type="file" class="form-control-file"
                                       name="signature" value="{{ old('signature') }}">
                                @error('signature')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('status') ? 'has-error' :'' }}">
                            <label class="col-sm-2 control-label">Status *</label>

                            <div class="col-sm-10">

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="1" {{ old('status', $employee->status) == '1' ? 'checked' : '' }}>
                                        Active
                                    </label>
                                </div>

                                <div class="radio" style="display: inline">
                                    <label>
                                        <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}>
                                        Inactive
                                    </label>
                                </div>

                                @error('status')
                                <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function () {
            // Select2
            $('.select2').select2();
            // Date picker
            $('.date').datepicker({
                autoclose: true,
                format: 'yyyy-mm-dd'
            });
        })
    </script>
@endsection
