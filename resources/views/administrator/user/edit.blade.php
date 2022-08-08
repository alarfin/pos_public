@extends('layouts.app')
@section('administrator', 'active menu-open')
@section('user_manage', 'active')
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/iCheck/square/blue.css') }}">
@endsection

@section('title')
    User Edit
@endsection

@section('content')
    <div class="row">
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('user_edit', ['user' => $user->id]) }}">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="col-sm-2 control-label">Name *</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                value="{{ empty(old('name')) ? ($errors->has('name') ? '' : $user->name) : old('name') }}">

                            @error('name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="col-sm-2 control-label">Email *</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter Email" name="email"
                                value="{{ empty(old('email')) ? ($errors->has('email') ? '' : $user->email) : old('email') }}">

                            @error('email')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                        <label class="col-sm-2 control-label"> Mobile no </label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Enter mobile_no" name="mobile_no"
                                value="{{ old('mobile_no', $user->mobile_no) }}">

                            @error('mobile_no')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label class="col-sm-2 control-label">Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Enter Password" name="password"
                                autocomplete="new-password">

                            @error('password')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Confirm Password</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" placeholder="Enter Confirm Password"
                                name="password_confirmation">
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <label>
                            <input type="checkbox" class="flat-green" id="checkAll"> Check All
                        </label>
                    </div>
                </div>
                <br>
                <!-- /.Start Administration -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green administrator" name="permission[]"
                                    value="administrator" id="administrator"
                                    {{ $user->can('administrator') ? 'checked' : '' }}> Administration
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="dashboard" id="dashboard" {{ $user->can('dashboard') ? 'checked' : '' }}>
                                    Dashboard
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="setting" id="setting" {{ $user->can('setting') ? 'checked' : '' }}>
                                    Setting
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="setting_edit" id="setting_edit"
                                        {{ $user->can('setting_edit') ? 'checked' : '' }}> Edit Setting
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch" id="company_branch"
                                        {{ $user->can('company_branch') ? 'checked' : '' }}> Company Branch
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch_add" id="company_branch_add"
                                        {{ $user->can('company_branch_add') ? 'checked' : '' }}> Branch add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch_edit" id="company_branch_edit"
                                        {{ $user->can('company_branch_edit') ? 'checked' : '' }}> Branch edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch_delete" id="company_branch_delete"
                                        {{ $user->can('company_branch_delete') ? 'checked' : '' }}> Branch delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="user" id="user" {{ $user->can('user') ? 'checked' : '' }}> User
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="user_add" id="user_add" {{ $user->can('user_add') ? 'checked' : '' }}>
                                    Add
                                    User
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="user_edit" id="user_edit" {{ $user->can('user_edit') ? 'checked' : '' }}>
                                    Edit User
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Bank -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green bank" name="permission[]" value="bank"
                                    id="bank" {{ $user->can('bank') ? 'checked' : '' }}> Bank
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green bank" name="permission[]" value="bank_add"
                                        id="bank_add" {{ $user->can('bank_add') ? 'checked' : '' }}> Bank add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green bank" name="permission[]" value="bank_edit"
                                        id="bank_edit" {{ $user->can('bank_edit') ? 'checked' : '' }}> Edit bank
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Supplier -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green supplier" name="permission[]" value="supplier"
                                    id="supplier" {{ $user->can('supplier') ? 'checked' : '' }}> Supplier
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green supplier" name="permission[]"
                                        value="supplier_add" id="supplier_add"
                                        {{ $user->can('supplier_add') ? 'checked' : '' }}> Supplier add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green supplier" name="permission[]"
                                        value="supplier_edit" id="supplier_edit"
                                        {{ $user->can('supplier_edit') ? 'checked' : '' }}> Supplier edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green supplier" name="permission[]"
                                        value="supplier_delete" id="supplier_delete"
                                        {{ $user->can('supplier_delete') ? 'checked' : '' }}> Supplier delete
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Customer -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green customer" name="permission[]" value="customer"
                                    id="customer" {{ $user->can('customer') ? 'checked' : '' }}> Customer
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green customer" name="permission[]"
                                        value="customer_add" id="customer_add"
                                        {{ $user->can('customer_add') ? 'checked' : '' }}> Customer add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green customer" name="permission[]"
                                        value="customer_edit" id="customer_edit"
                                        {{ $user->can('customer_edit') ? 'checked' : '' }}> Customer edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green customer" name="permission[]"
                                        value="customer_delete" id="customer_delete"
                                        {{ $user->can('customer_delete') ? 'checked' : '' }}> Customer delete
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start HR -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green hr" name="permission[]" value="hr"
                                    id="hr" {{ $user->can('hr') ? 'checked' : '' }}> HR
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]" value="designation"
                                        id="designation" {{ $user->can('designation') ? 'checked' : '' }}> Designation
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="designation_add" id="designation_add"
                                        {{ $user->can('designation_add') ? 'checked' : '' }}> Designation
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="designation_edit" id="designation_edit"
                                        {{ $user->can('designation_edit') ? 'checked' : '' }}> Designation edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="designation_delete" id="designation_delete"
                                        {{ $user->can('designation_delete') ? 'checked' : '' }}> Designation delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]" value="employee"
                                        id="employee" {{ $user->can('employee') ? 'checked' : '' }}> Employee
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_add" id="employee_add"
                                        {{ $user->can('employee_add') ? 'checked' : '' }}> Employee add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_edit" id="employee_edit"
                                        {{ $user->can('employee_edit') ? 'checked' : '' }}> Employee edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_delete" id="employee_delete"
                                        {{ $user->can('employee_delete') ? 'checked' : '' }}> Employee
                                    delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_attendance" id="employee_attendance"
                                        {{ $user->can('employee_attendance') ? 'checked' : '' }}> Employee attendance
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_attendance_add" id="employee_attendance_add"
                                        {{ $user->can('employee_attendance_add') ? 'checked' : '' }}> Employee attendance
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_attendance_edit" id="employee_attendance_edit"
                                        {{ $user->can('employee_attendance_edit') ? 'checked' : '' }}> Employee attendance
                                    edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="salary_process" id="salary_process"
                                        {{ $user->can('salary_process') ? 'checked' : '' }}> Salary
                                    Process
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="salary_process_add" id="salary_process_add"
                                        {{ $user->can('salary_process_add') ? 'checked' : '' }}> Salary Process add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="salary_process_edit" id="salary_process_edit"
                                        {{ $user->can('salary_process_edit') ? 'checked' : '' }}> Salary Process edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="salary_process_delete" id="salary_process_delete"
                                        {{ $user->can('salary_process_delete') ? 'checked' : '' }}> Salary Process delete
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Product -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green products" name="permission[]" value="products"
                                    id="products" {{ $user->can('products') ? 'checked' : '' }}> Products
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_unit" id="product_unit"
                                        {{ $user->can('product_unit') ? 'checked' : '' }}> Product unit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_unit_add" id="product_unit_add"
                                        {{ $user->can('product_unit_add') ? 'checked' : '' }}> Product unit add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_unit_edit" id="product_unit_edit"
                                        {{ $user->can('product_unit_edit') ? 'checked' : '' }}> Product unit edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_unit_delete" id="product_unit_delete"
                                        {{ $user->can('product_unit_delete') ? 'checked' : '' }}> Product unit delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category" id="product_category"
                                        {{ $user->can('product_category') ? 'checked' : '' }}> Product category
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category_add" id="product_category_add"
                                        {{ $user->can('product_category_add') ? 'checked' : '' }}> Product category add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category_edit" id="product_category_edit"
                                        {{ $user->can('product_category_edit') ? 'checked' : '' }}> Product category edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category_delete" id="product_category_delete"
                                        {{ $user->can('product_category_delete') ? 'checked' : '' }}> Product category
                                    delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand" id="product_brand"
                                        {{ $user->can('product_brand') ? 'checked' : '' }}> Product brand
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand_add" id="product_brand_add"
                                        {{ $user->can('product_brand_add') ? 'checked' : '' }}> Product brand add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand_edit" id="product_brand_edit"
                                        {{ $user->can('product_brand_edit') ? 'checked' : '' }}> Product brand edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand_delete" id="product_brand_delete"
                                        {{ $user->can('product_brand_delete') ? 'checked' : '' }}> Product brand delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color" id="product_color"
                                        {{ $user->can('product_color') ? 'checked' : '' }}> Product color
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color_add" id="product_color_add"
                                        {{ $user->can('product_color_add') ? 'checked' : '' }}> Product color add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color_edit" id="product_color_edit"
                                        {{ $user->can('product_color_edit') ? 'checked' : '' }}> Product color edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color_delete" id="product_color_delete"
                                        {{ $user->can('product_color_delete') ? 'checked' : '' }}> Product color delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size" id="product_size"
                                        {{ $user->can('product_size') ? 'checked' : '' }}> Product size
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size_add" id="product_size_add"
                                        {{ $user->can('product_size_add') ? 'checked' : '' }}> Product size add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size_edit" id="product_size_edit"
                                        {{ $user->can('product_size_edit') ? 'checked' : '' }}> Product size edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size_delete" id="product_size_delete"
                                        {{ $user->can('product_size_delete') ? 'checked' : '' }}> Product size delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product" id="product" {{ $user->can('product') ? 'checked' : '' }}>
                                    Product
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_add" id="product_add"
                                        {{ $user->can('product_add') ? 'checked' : '' }}> Product add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_edit" id="product_edit"
                                        {{ $user->can('product_edit') ? 'checked' : '' }}> Product edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_delete" id="product_delete"
                                        {{ $user->can('product_delete') ? 'checked' : '' }}> Product delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_transfers" id="product_transfers"
                                        {{ $user->can('product_transfers') ? 'checked' : '' }}> Product transfers
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_transfer_create" id="product_transfer_create"
                                        {{ $user->can('product_transfer_create') ? 'checked' : '' }}> Product transfer add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_transfer_delete" id="product_transfer_delete"
                                        {{ $user->can('product_transfer_delete') ? 'checked' : '' }}> Product transfer
                                    delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_damage" id="product_damage"
                                        {{ $user->can('product_damage') ? 'checked' : '' }}> Product damage
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_damage_add" id="product_damage_add"
                                        {{ $user->can('product_damage_add') ? 'checked' : '' }}> Product damage add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_damage_delete" id="product_damage_delete"
                                        {{ $user->can('product_damage_delete') ? 'checked' : '' }}> Product damage delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_inventory" id="product_inventory"
                                        {{ $user->can('product_inventory') ? 'checked' : '' }}> Product Invenory
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_inventory_details" id="product_inventory_details"
                                        {{ $user->can('product_inventory_details') ? 'checked' : '' }}> Invenory details
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Purchase -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green purchase" name="permission[]" value="purchase"
                                    id="purchase" {{ $user->can('purchase') ? 'checked' : '' }}> Purchase
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green purchase" name="permission[]"
                                        value="purchase_add" id="purchase_add"
                                        {{ $user->can('purchase_add') ? 'checked' : '' }}> Purchase add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green purchase" name="permission[]"
                                        value="purchase_edit" id="purchase_edit"
                                        {{ $user->can('purchase_edit') ? 'checked' : '' }}> Purchase edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green purchase" name="permission[]"
                                        value="supplier_payment" id="supplier_payment"
                                        {{ $user->can('supplier_payment') ? 'checked' : '' }}> Supplier Payment
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Price Quotation -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green price_quotation" name="permission[]"
                                    value="price_quotation" id="price_quotation"
                                    {{ $user->can('price_quotation') ? 'checked' : '' }}> Price quotation
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green price_quotation" name="permission[]"
                                        value="price_quotation_add" id="price_quotation_add"
                                        {{ $user->can('price_quotation_add') ? 'checked' : '' }}> price quotation add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green price_quotation" name="permission[]"
                                        value="price_quotation_edit" id="price_quotation_edit"
                                        {{ $user->can('price_quotation_edit') ? 'checked' : '' }}> Price quotation edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green price_quotation" name="permission[]"
                                        value="price_quotation_delete" id="price_quotation_delete"
                                        {{ $user->can('price_quotation_delete') ? 'checked' : '' }}> Price quotation delete
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Sale -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green sale" name="permission[]" value="sale"
                                    id="sale" {{ $user->can('sale') ? 'checked' : '' }}> Sale
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]" value="sale_add"
                                        id="sale_add" {{ $user->can('sale_add') ? 'checked' : '' }}> Sale add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]" value="sale_edit"
                                        id="sale_edit" {{ $user->can('sale_edit') ? 'checked' : '' }}> Sale edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]"
                                        value="sale_delete" id="sale_delete"
                                        {{ $user->can('sale_delete') ? 'checked' : '' }}> Sale delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]"
                                        value="customer_payment" id="customer_payment"
                                        {{ $user->can('customer_payment') ? 'checked' : '' }}> Customer Payment
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Return -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green return" name="permission[]" value="return"
                                    id="return" {{ $user->can('return') ? 'checked' : '' }}> Return
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green return" name="permission[]"
                                        value="purchase_return" id="purchase_return"
                                        {{ $user->can('purchase_return') ? 'checked' : '' }}> Purchase return
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]"
                                        value="sale_return" id="sale_return"
                                        {{ $user->can('sale_return') ? 'checked' : '' }}> Sale return
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Other's Income -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green others_income" name="permission[]"
                                    value="others_income" id="others_income"
                                    {{ $user->can('others_income') ? 'checked' : '' }}> Other's income
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_income" name="permission[]"
                                        value="others_income_add" id="others_income_add"
                                        {{ $user->can('others_income_add') ? 'checked' : '' }}> Other's income add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_income" name="permission[]"
                                        value="others_income_edit" id="others_income_edit"
                                        {{ $user->can('others_income_edit') ? 'checked' : '' }}> Other's income edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_income" name="permission[]"
                                        value="others_income_delete" id="others_income_delete"
                                        {{ $user->can('others_income_delete') ? 'checked' : '' }}> Other's income delete
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Other's Expense -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green others_expense" name="permission[]"
                                    value="others_expense" id="others_expense"
                                    {{ $user->can('others_expense') ? 'checked' : '' }}> Other's expense
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_expense" name="permission[]"
                                        value="others_expense_add" id="others_expense_add"
                                        {{ $user->can('others_expense_add') ? 'checked' : '' }}> Other's expense add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_expense" name="permission[]"
                                        value="others_expense_edit" id="others_expense_edit"
                                        {{ $user->can('others_expense_edit') ? 'checked' : '' }}> Other's expense edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_expense" name="permission[]"
                                        value="others_expense_delete" id="others_expense_delete"
                                        {{ $user->can('others_expense_delete') ? 'checked' : '' }}> Other's expense delete
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Accounts -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green accounts" name="permission[]" value="accounts"
                                    id="accounts" {{ $user->can('accounts') ? 'checked' : '' }}> Accounts
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_head" id="account_head"
                                        {{ $user->can('account_head') ? 'checked' : '' }}> Account head
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_head_add" id="account_head_add"
                                        {{ $user->can('account_head_add') ? 'checked' : '' }}> Account head add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_head_edit" id="account_head_edit"
                                        {{ $user->can('account_head_edit') ? 'checked' : '' }}> Account head edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account" id="account" {{ $user->can('account') ? 'checked' : '' }}>
                                    Account
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_add" id="account_add"
                                        {{ $user->can('account_add') ? 'checked' : '' }}> Account add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_edit" id="account_edit"
                                        {{ $user->can('account_edit') ? 'checked' : '' }}> Account edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="debit_transaction" id="debit_transaction"
                                        {{ $user->can('debit_transaction') ? 'checked' : '' }}> Debit transaction
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="employee_debit_transaction_add" id="employee_debit_transaction_add"
                                        {{ $user->can('employee_debit_transaction_add') ? 'checked' : '' }}> Employee
                                    debit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="supplier_debit_transaction_add" id="supplier_debit_transaction_add"
                                        {{ $user->can('supplier_debit_transaction_add') ? 'checked' : '' }}> Supplier
                                    debit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="debit_transaction_add" id="debit_transaction_add"
                                        {{ $user->can('debit_transaction_add') ? 'checked' : '' }}> Debit add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="credit_transaction" id="credit_transaction"
                                        {{ $user->can('credit_transaction') ? 'checked' : '' }}> Credit transaction
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="employee_credit_transaction_add" id="employee_credit_transaction_add"
                                        {{ $user->can('employee_credit_transaction_add') ? 'checked' : '' }}> Employee
                                    credit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="supplier_credit_transaction_add" id="supplier_credit_transaction_add"
                                        {{ $user->can('supplier_credit_transaction_add') ? 'checked' : '' }}> Supplier
                                    credit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="credit_transaction_add" id="credit_transaction_add"
                                        {{ $user->can('credit_transaction_add') ? 'checked' : '' }}> Credit add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="balance_transfer" id="balance_transfer"
                                        {{ $user->can('balance_transfer') ? 'checked' : '' }}> Balance transfer
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="balance_transfer_add" id="balance_transfer_add"
                                        {{ $user->can('balance_transfer_add') ? 'checked' : '' }}> Balance transfer add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_adjustment" id="account_adjustment"
                                        {{ $user->can('account_adjustment') ? 'checked' : '' }}> Account adjustment
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_adjustment_add" id="account_adjustment_add"
                                        {{ $user->can('account_adjustment_add') ? 'checked' : '' }}> Account adjustment
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="opening_balance" id="opening_balance"
                                        {{ $user->can('opening_balance') ? 'checked' : '' }}> Opening Balance
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="employee_opening_add" id="employee_opening_add"
                                        {{ $user->can('employee_opening_add') ? 'checked' : '' }}> Employee opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="customer_opening_add" id="customer_opening_add"
                                        {{ $user->can('customer_opening_add') ? 'checked' : '' }}> Customer opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="supplier_opening_add" id="supplier_opening_add"
                                        {{ $user->can('supplier_opening_add') ? 'checked' : '' }}> Supplier opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="bank_opening_add" id="bank_opening_add"
                                        {{ $user->can('bank_opening_add') ? 'checked' : '' }}> Bank opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_opening_add" id="account_opening_add"
                                        {{ $user->can('account_opening_add') ? 'checked' : '' }}> Account opening add
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.Start Report -->
                <div class="box box-default collapsed-box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <label>
                                <input type="checkbox" class="flat-green report" name="permission[]" value="report"
                                    id="report" {{ $user->can('report') ? 'checked' : '' }}> Report
                            </label>
                        </h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body" style="display:none">
                        <div class="row">
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="chart_of_account" id="chart_of_account"
                                        {{ $user->can('chart_of_account') ? 'checked' : '' }}> Chart of account
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="trial_balance" id="trial_balance"
                                        {{ $user->can('trial_balance') ? 'checked' : '' }}> Trial Balance
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]" value="ledger"
                                        id="ledger" {{ $user->can('ledger') ? 'checked' : '' }}> Ledger
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="cash_bank_statement" id="cash_bank_statement"
                                        {{ $user->can('cash_bank_statement') ? 'checked' : '' }}> Cash & Bank Statement
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="salary_sheet" id="salary_sheet"
                                        {{ $user->can('salary_sheet') ? 'checked' : '' }}> Salary sheet
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="supplier_report" id="supplier_report"
                                        {{ $user->can('supplier_report') ? 'checked' : '' }}> Supplier report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="supplier_due_report" id="supplier_due_report"
                                        {{ $user->can('supplier_due_report') ? 'checked' : '' }}> Supplier due report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="customer_report" id="customer_report"
                                        {{ $user->can('customer_report') ? 'checked' : '' }}> Customer report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="customer_due_report" id="customer_due_report"
                                        {{ $user->can('customer_due_report') ? 'checked' : '' }}> Customer due report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_purchase" id="report_purchase"
                                        {{ $user->can('report_purchase') ? 'checked' : '' }}> Purchase report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_purchase_product" id="report_purchase_product"
                                        {{ $user->can('report_purchase_product') ? 'checked' : '' }}> Purchase product
                                    report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_purchase_product_return" id="report_purchase_product_return"
                                        {{ $user->can('report_purchase_product_return') ? 'checked' : '' }}> Purchase
                                    return report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale" id="report_sale"
                                        {{ $user->can('report_sale') ? 'checked' : '' }}> Sale report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale_product" id="report_sale_product"
                                        {{ $user->can('report_sale_product') ? 'checked' : '' }}> Sale products report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale_product_return" id="report_sale_product_return"
                                        {{ $user->can('report_sale_product_return') ? 'checked' : '' }}> Sale return
                                    report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_stock" id="report_stock"
                                        {{ $user->can('report_stock') ? 'checked' : '' }}> Stock report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale_profit_loss" id="report_sale_profit_loss"
                                        {{ $user->can('report_sale_profit_loss') ? 'checked' : '' }}> Sale profit-loss
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="net_profit_loss" id="net_profit_loss"
                                        {{ $user->can('net_profit_loss') ? 'checked' : '' }}> Net profit loss
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="daily_balance_summary" id="daily_balance_summary"
                                        {{ $user->can('daily_balance_summary') ? 'checked' : '' }}> Daily Balance Summary
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('themes/backend/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('themes/backend/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function() {
            $('.select2').select2()
            $("#checkAll").click(function() {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });

            // Administrator
            $('#administrator').click(function() {
                if ($(this).prop('checked')) {
                    $('.administrator').not(this).prop('checked', this.checked);
                } else {
                    $('.administrator').not(this).prop('checked', false);
                }
            });

            // Bank
            $('#bank').click(function() {
                if ($(this).prop('checked')) {
                    $('.bank').not(this).prop('checked', this.checked);
                } else {
                    $('.bank').not(this).prop('checked', false);
                }
            });
            // Supplier
            $('#supplier').click(function() {
                if ($(this).prop('checked')) {
                    $('.supplier').not(this).prop('checked', this.checked);
                } else {
                    $('.supplier').not(this).prop('checked', false);
                }
            });
            // Customer
            $('#customer').click(function() {
                if ($(this).prop('checked')) {
                    $('.customer').not(this).prop('checked', this.checked);
                } else {
                    $('.customer').not(this).prop('checked', false);
                }
            });
            // HR
            $('#hr').click(function() {
                if ($(this).prop('checked')) {
                    $('.hr').not(this).prop('checked', this.checked);
                } else {
                    $('.hr').not(this).prop('checked', false);
                }
            });
            // Products
            $('#products').click(function() {
                if ($(this).prop('checked')) {
                    $('.products').not(this).prop('checked', this.checked);
                } else {
                    $('.products').not(this).prop('checked', false);
                }
            });
            // Purchase Product
            $('#purchase').click(function() {
                if ($(this).prop('checked')) {
                    $('.purchase').not(this).prop('checked', this.checked);
                } else {
                    $('.purchase').not(this).prop('checked', false);
                }
            });
            // Price quotation
            $('#price_quotation').click(function() {
                if ($(this).prop('checked')) {
                    $('.price_quotation').not(this).prop('checked', this.checked);
                } else {
                    $('.price_quotation').not(this).prop('checked', false);
                }
            });
            // Sale Product
            $('#sale').click(function() {
                if ($(this).prop('checked')) {
                    $('.sale').not(this).prop('checked', this.checked);
                } else {
                    $('.sale').not(this).prop('checked', false);
                }
            });
            // Return Product
            $('#return').click(function() {
                if ($(this).prop('checked')) {
                    $('.return').not(this).prop('checked', this.checked);
                } else {
                    $('.return').not(this).prop('checked', false);
                }
            });
            // Other's Income
            $('#others_income').click(function() {
                if ($(this).prop('checked')) {
                    $('.others_income').not(this).prop('checked', this.checked);
                } else {
                    $('.others_income').not(this).prop('checked', false);
                }
            });
            // Other's Expense
            $('#others_expense').click(function() {
                if ($(this).prop('checked')) {
                    $('.others_expense').not(this).prop('checked', this.checked);
                } else {
                    $('.others_expense').not(this).prop('checked', false);
                }
            });
            // Account & Transaction
            $('#accounts').click(function() {
                if ($(this).prop('checked')) {
                    $('.accounts').not(this).prop('checked', this.checked);
                } else {
                    $('.accounts').not(this).prop('checked', false);
                }
            });
            // Report
            $('#report').click(function() {
                if ($(this).prop('checked')) {
                    $('.report').not(this).prop('checked', this.checked);
                } else {
                    $('.report').not(this).prop('checked', false);
                }
            });

        });
    </script>
@endsection
