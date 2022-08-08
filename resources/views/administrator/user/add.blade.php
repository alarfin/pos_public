@extends('layouts.app')
@section('administrator', 'active menu-open')
@section('user_add', 'active')
@section('style')
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('themes/backend/plugins/iCheck/square/blue.css') }}">
@endsection

@section('title')
    User Add
@endsection

@section('content')
    <div class="row">
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="{{ route('user_add') }}">
            @csrf
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">User Information</h3>
                    </div>
                    <!-- /.box-header -->

                    <div class="box-body">

                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Name *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Name" name="name"
                                    value="{{ old('name') }}">

                                @error('name')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Email *</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter Email" name="email"
                                    value="{{ old('email') }}">

                                @error('email')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('mobile_no') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label"> Mobile no </label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" placeholder="Enter mobile_no" name="mobile_no"
                                    value="{{ old('mobile_no') }}">

                                @error('mobile_no')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            <label class="col-sm-2 control-label">Password *</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" placeholder="Enter Password" name="password"
                                    autocomplete="new-password">

                                @error('password')
                                    <span class="help-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirm Password *</label>

                            <div class="col-sm-10">
                                <input type="password" class="form-control" placeholder="Enter Confirm Password"
                                    name="password_confirmation">
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->

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
                                    value="administrator" id="administrator"> Administration
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
                                        value="dashboard" id="dashboard">
                                    Dashboard
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="setting" id="setting">
                                    Setting
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="setting_edit" id="setting_edit"> Edit Setting
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch" id="company_branch"> Company Branch
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch_add" id="company_branch_add"> Branch add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch_edit" id="company_branch_edit"> Branch edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="company_branch_delete" id="company_branch_delete"> Branch delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="user" id="user"> User
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="user_add" id="user_add">
                                    Add
                                    User
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green administrator" name="permission[]"
                                        value="user_edit" id="user_edit">
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
                                    id="bank"> Bank
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
                                        id="bank_add"> Bank add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green bank" name="permission[]" value="bank_edit"
                                        id="bank_edit"> Edit bank
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
                                    id="supplier"> Supplier
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
                                        value="supplier_add" id="supplier_add"> Supplier add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green supplier" name="permission[]"
                                        value="supplier_edit" id="supplier_edit"> Supplier edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green supplier" name="permission[]"
                                        value="supplier_delete" id="supplier_delete"> Supplier delete
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
                                    id="customer"> Customer
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
                                        value="customer_add" id="customer_add"> Customer add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green customer" name="permission[]"
                                        value="customer_edit" id="customer_edit"> Customer edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green customer" name="permission[]"
                                        value="customer_delete" id="customer_delete"> Customer delete
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
                                    id="hr"> HR
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
                                        id="designation"> Designation
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="designation_add" id="designation_add"> Designation
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="designation_edit" id="designation_edit"> Designation edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="designation_delete" id="designation_delete"> Designation delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]" value="employee"
                                        id="employee"> Employee
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_add" id="employee_add"> Employee add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_edit" id="employee_edit"> Employee edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_delete" id="employee_delete"> Employee
                                    delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_attendance" id="employee_attendance"> Employee attendance
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_attendance_add" id="employee_attendance_add"> Employee attendance
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="employee_attendance_edit" id="employee_attendance_edit"> Employee
                                    attendance
                                    edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="salary_process" id="salary_process"> Salary
                                    Process
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green hr" name="permission[]"
                                        value="salary_process_add" id="salary_process_add"> Salary Process add
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
                                    id="products"> Products
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
                                        value="product_unit" id="product_unit"> Product unit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_unit_add" id="product_unit_add"> Product unit add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_unit_edit" id="product_unit_edit"> Product unit edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_unit_delete" id="product_unit_delete"> Product unit delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category" id="product_category"> Product category
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category_add" id="product_category_add"> Product category add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category_edit" id="product_category_edit"> Product category edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_category_delete" id="product_category_delete"> Product category
                                    delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand" id="product_brand"> Product brand
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand_add" id="product_brand_add"> Product brand add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand_edit" id="product_brand_edit"> Product brand edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_brand_delete" id="product_brand_delete"> Product brand delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color" id="product_color"> Product color
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color_add" id="product_color_add"> Product color add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color_edit" id="product_color_edit"> Product color edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_color_delete" id="product_color_delete"> Product color delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size" id="product_size"> Product size
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size_add" id="product_size_add"> Product size add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size_edit" id="product_size_edit"> Product size edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_size_delete" id="product_size_delete"> Product size delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product" id="product">
                                    Product
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_add" id="product_add"> Product add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_edit" id="product_edit"> Product edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_delete" id="product_delete"> Product delete
                                </label>
                            </div>

                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_transfers" id="product_transfers"> Product transfers
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_transfer_create" id="product_transfer_create"> Product transfer add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_transfer_delete" id="product_transfer_delete"> Product transfer
                                    delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_damage" id="product_damage"> Product damage
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_damage_add" id="product_damage_add"> Product damage add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_damage_delete" id="product_damage_delete"> Product damage delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_inventory" id="product_inventory"> Product Invenory
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green products" name="permission[]"
                                        value="product_inventory_details" id="product_inventory_details"> Invenory details
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
                                    id="purchase"> Purchase
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
                                        value="purchase_add" id="purchase_add"> Purchase add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green purchase" name="permission[]"
                                        value="purchase_edit" id="purchase_edit"> Purchase edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green purchase" name="permission[]"
                                        value="supplier_payment" id="supplier_payment"> Supplier Payment
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
                                    value="price_quotation" id="price_quotation"> Price quotation
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
                                        value="price_quotation_add" id="price_quotation_add"> price quotation add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green price_quotation" name="permission[]"
                                        value="price_quotation_edit" id="price_quotation_edit"> Price quotation edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green price_quotation" name="permission[]"
                                        value="price_quotation_delete" id="price_quotation_delete"> Price quotation delete
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
                                    id="sale"> Sale
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
                                        id="sale_add"> Sale add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]" value="sale_edit"
                                        id="sale_edit"> Sale edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]"
                                        value="sale_delete" id="sale_delete"> Sale delete
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]"
                                        value="customer_payment" id="customer_payment"> Customer Payment
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
                                    id="return"> Return
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
                                        value="purchase_return" id="purchase_return"> Purchase return
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green sale" name="permission[]"
                                        value="sale_return" id="sale_return"> Sale return
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
                                    value="others_income" id="others_income"> Other's income
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
                                        value="others_income_add" id="others_income_add"> Other's income add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_income" name="permission[]"
                                        value="others_income_edit" id="others_income_edit"> Other's income edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_income" name="permission[]"
                                        value="others_income_delete" id="others_income_delete"> Other's income delete
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
                                    value="others_expense" id="others_expense"> Other's expense
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
                                        value="others_expense_add" id="others_expense_add"> Other's expense add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_expense" name="permission[]"
                                        value="others_expense_edit" id="others_expense_edit"> Other's expense edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green others_expense" name="permission[]"
                                        value="others_expense_delete" id="others_expense_delete"> Other's expense delete
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
                                    id="accounts"> Accounts
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
                                        value="account_head" id="account_head"> Account head
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_head_add" id="account_head_add"> Account head add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_head_edit" id="account_head_edit"> Account head edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]">
                                    Account
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_add" id="account_add"> Account add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_edit" id="account_edit"> Account edit
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="debit_transaction" id="debit_transaction"> Debit transaction
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="employee_debit_transaction_add" id="employee_debit_transaction_add">
                                    Employee
                                    debit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="supplier_debit_transaction_add" id="supplier_debit_transaction_add">
                                    Supplier
                                    debit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="debit_transaction_add" id="debit_transaction_add"> Debit add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="credit_transaction" id="credit_transaction"> Credit transaction
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="employee_credit_transaction_add" id="employee_credit_transaction_add">
                                    Employee
                                    credit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="supplier_credit_transaction_add" id="supplier_credit_transaction_add">
                                    Supplier
                                    credit
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="credit_transaction_add" id="credit_transaction_add"> Credit add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="balance_transfer" id="balance_transfer"> Balance transfer
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="balance_transfer_add" id="balance_transfer_add"> Balance transfer add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_adjustment" id="account_adjustment"> Account adjustment
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_adjustment_add" id="account_adjustment_add"> Account adjustment
                                    add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="opening_balance" id="opening_balance"> Opening Balance
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="employee_opening_add" id="employee_opening_add"> Employee opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="customer_opening_add" id="customer_opening_add"> Customer opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="supplier_opening_add" id="supplier_opening_add"> Supplier opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="bank_opening_add" id="bank_opening_add"> Bank opening add
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green accounts" name="permission[]"
                                        value="account_opening_add" id="account_opening_add"> Account opening add
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
                                    id="report"> Report
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
                                        value="chart_of_account" id="chart_of_account"> Chart of account
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="trial_balance" id="trial_balance"> Trial Balance
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]" value="ledger"
                                        id="ledger"> Ledger
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="cash_bank_statement" id="cash_bank_statement"> Cash & Bank Statement
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="salary_sheet" id="salary_sheet"> Salary sheet
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="supplier_report" id="supplier_report"> Supplier report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="supplier_due_report" id="supplier_due_report"> Supplier due report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="customer_report" id="customer_report"> Customer report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="customer_due_report" id="customer_due_report"> Customer due report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_purchase" id="report_purchase"> Purchase report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_purchase_product" id="report_purchase_product"> Purchase product
                                    report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"> Purchase
                                    return report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale" id="report_sale"> Sale report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale_product" id="report_sale_product"> Sale products report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale_product_return" id="report_sale_product_return"> Sale return
                                    report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_stock" id="report_stock"> Stock report
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="report_sale_profit_loss" id="report_sale_profit_loss"> Sale profit-loss
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="net_profit_loss" id="net_profit_loss"> Net profit loss
                                </label>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    <input type="checkbox" class="flat-green report" name="permission[]"
                                        value="daily_balance_summary" id="daily_balance_summary"> Daily Balance Summary
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
