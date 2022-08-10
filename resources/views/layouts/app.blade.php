@if (Auth::check() && Auth::user()->logged_section_id == 0)
    <script>
        window.location = "{{ route('section_login') }}";
    </script>
@endif

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title', config('app.name')) </title>

    <!--Favicon-->
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('themes/backend/bower_components/Ionicons/css/ionicons.min.css') }}">

    @yield('style')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('themes/backend/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('themes/backend/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/css/custom.css') }}">
    <style>
        .table>caption+thead>tr:first-child>td,
        .table>caption+thead>tr:first-child>th,
        .table>colgroup+thead>tr:first-child>td,
        .table>colgroup+thead>tr:first-child>th,
        .table>thead:first-child>tr:first-child>td,
        .table>thead:first-child>tr:first-child>th {
            border-top: 1px solid #ddd;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>thead>tr>td {
            border: 1px solid #ddd;
        }

        .table-bordered>thead>tr>th,
        .table-bordered>tbody>tr>th,
        .table-bordered>tfoot>tr>th,
        .table-bordered>thead>tr>td,
        .table-bordered>tbody>tr>td,
        .table-bordered>tfoot>tr>td {
            border: 1px solid #ddd !important;
        }

        .table th {
            vertical-align: middle !important;
        }

        .table td {
            vertical-align: middle !important;
        }

        .select2 {
            width: 100% !important;
        }

        .btn {
            margin: 1px !important;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ route('dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>AP</b></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>Panel</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <h4 class="pull-left" style="color: white; margin-top: 15px; padding-left: 20px">
                    {{ config('app.name') }}</h4>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">{{ count($layoutData['stocks']) }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have
                                    {{ count($layoutData['stocks']) }}
                                    notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        {{-- @foreach ($layoutData['nextPayments'] as $nextPayment)
                                            <li>
                                                <a
                                                    href="{{ route('sale_order_details', ['sale_order' => $nextPayment->id]) }}">
                                                    <i class="fa fa-dollar text-success"></i> Order No.
                                                    {{ $nextPayment->order_no }} payment date
                                                </a>
                                            </li>
                                        @endforeach --}}

                                        @foreach ($layoutData['stocks'] as $stock)
                                            <li>
                                                <a href="{{ route('inventory') }}"
                                                    title="{{ $stock->name }} stock {{ $stock->stockQuantity() }} pcs">
                                                    <i class="fa fa-calculator text-warning"></i> {{ $stock->name }}
                                                    stock {{ $stock->stockQuantity() }} pcs
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{ asset('img/avatar.png') }}" class="user-image" alt="Avatar">
                                <span class="hidden-xs">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                            class="btn btn-default btn-flat">Sign out</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    @can('administrator')
                        <li class="treeview @yield('administrator')">
                            <a href="#">
                                <i class="fa fa-cogs text-blue"></i> <span>Administrator</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('administrator')">
                                @can('setting')
                                    <li class="@yield('setting')">
                                        <a href="{{ route('setting') }}"><i class="fa fa-space-shuttle"></i> Setting </a>
                                    </li>
                                @endcan


                                @can('company_branch')
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-space-shuttle"></i> Company branch
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu" style="@yield('company_branch')">
                                            @can('company_branch_add')
                                                <li class="@yield('company_branch_add')">
                                                    <a href="{{ route('company_branch_add') }}"><i class="fa fa-space-shuttle"></i>
                                                        Add company branch </a>
                                                </li>
                                            @endcan
                                            <li class="@yield('company_branch_manage')">
                                                <a href="{{ route('company_branches') }}"><i class="fa fa-space-shuttle"></i>
                                                    Manage company branch </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('user')
                                    @can('user_add')
                                        <li class="@yield('user_add')">
                                            <a href="{{ route('user_add') }}"><i class="fa fa-space-shuttle"></i> Add User </a>
                                        </li>
                                    @endcan

                                    <li class="@yield('user_manage')">
                                        <a href="{{ route('user_all') }}"><i class="fa fa-space-shuttle"></i> Manage User
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endcan



                    @can('bank')
                        <li class="treeview @yield('bank')">
                            <a href="#">
                                <i class="fa fa-university text-blue"></i> <span>Bank</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('bank')">
                                @can('bank_add')
                                    <li class="@yield('bank_add')">
                                        <a href="{{ route('bank_add') }}"><i class="fa fa-space-shuttle"></i> Add Bank</a>
                                    </li>
                                @endcan
                                <li class="@yield('bank_manage')">
                                    <a href="{{ route('bank') }}"><i class="fa fa-space-shuttle"></i> Manage Bank</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('supplier')
                        <li class="treeview @yield('supplier')">
                            <a href="#">
                                <i class="fa fa-users text-blue"></i> <span> Supplier</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('supplier')">
                                @can('supplier_add')
                                    <li class="@yield('supplier_add')">
                                        <a href="{{ route('supplier_add') }}"><i class="fa fa-space-shuttle"></i> Add
                                            supplier</a>
                                    </li>
                                @endcan
                                <li class="@yield('supplier_manage')">
                                    <a href="{{ route('supplier') }}"><i class="fa fa-space-shuttle"></i> Manage
                                        supplier</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('customer')
                        <li class="treeview @yield('customer')">
                            <a href="#">
                                <i class="fa fa-users text-blue"></i> <span> Customer</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('customer')">
                                @can('customer_add')
                                    <li class="@yield('customer_add')">
                                        <a href="{{ route('customer_add') }}"><i class="fa fa-space-shuttle"></i> Add
                                            customer</a>
                                    </li>
                                @endcan
                                <li class="@yield('customer_manage')">
                                    <a href="{{ route('customer') }}"><i class="fa fa-space-shuttle"></i> Manage
                                        customer</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('products')
                        <li class="treeview @yield('product')">
                            <a href="#">
                                <i class="fa fa-product-hunt text-blue"></i> <span> Product </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('product')">

                                @can('product_unit')
                                    <li class="@yield('product_units')">
                                        <a href="{{ route('product_units') }}"><i class="fa fa-space-shuttle"></i>
                                            Product Unit </a>
                                    </li>
                                @endcan
                                @can('product_category')
                                    <li class="@yield('product_categories')">
                                        <a href="{{ route('product_categories') }}"><i class="fa fa-space-shuttle"></i>
                                            Product Category </a>
                                    </li>
                                @endcan
                                @can('product_brand')
                                    <li class="@yield('product_brand_manage')">
                                        <a href="{{ route('product_brands') }}"><i class="fa fa-space-shuttle"></i>
                                            Product Brands </a>
                                    </li>
                                @endcan
                                {{-- @can('product_color') --}}
                                <li class="@yield('product_color_manage')">
                                    <a href="{{ route('product_colors') }}"><i class="fa fa-space-shuttle"></i>
                                        Product Color </a>
                                </li>
                                {{-- @endcan --}}
                                {{-- @can('product_size') --}}
                                <li class="@yield('product_size_manage')">
                                    <a href="{{ route('product_sizes') }}"><i class="fa fa-space-shuttle"></i>
                                        Product Size </a>
                                </li>
                                {{-- @endcan --}}
                                @can('product_add')
                                    <li class="@yield('product_add')">
                                        <a href="{{ route('product_add') }}"><i class="fa fa-space-shuttle"></i> Add
                                            Product </a>
                                    </li>
                                @endcan
                                @can('product')
                                    <li class="@yield('product_manage')">
                                        <a href="{{ route('products') }}"><i class="fa fa-space-shuttle"></i> Manage
                                            product</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('purchase')
                        <li class="treeview @yield('purchase')">
                            <a href="#">
                                <i class="fa fa-buysellads text-blue"></i> <span>Purchase</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('purchase')">
                                @can('purchase_add')
                                    <li class="@yield('purchase_order_create')">
                                        <a href="{{ route('purchase_order_create') }}"><i class="fa fa-space-shuttle"></i>
                                            New Purchase </a>
                                    </li>
                                @endcan

                                <li class="@yield('purchase_order_manage')">
                                    <a href="{{ route('purchase_orders') }}"><i class="fa fa-space-shuttle"></i>
                                        Manage Purchase </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('price_quotation')
                        <li class="treeview @yield('price_quotation')">
                            <a href="#">
                                <i class="fa fa-shopping-cart text-blue"></i> <span> Price quotations </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('price_quotation')">
                                @can('price_quotation_add')
                                    <li class="@yield('price_quotation_create')">
                                        <a href="{{ route('price_quotation_create') }}"><i class="fa fa-space-shuttle"></i>
                                            Add price quotation </a>
                                    </li>
                                @endcan

                                <li class="@yield('price_quotation_manage')">
                                    <a href="{{ route('price_quotations') }}"><i class="fa fa-space-shuttle"></i>
                                        Manage
                                        Price quotations </a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('sale')
                        <li class="treeview @yield('sale')">
                            <a href="#">
                                <i class="fa fa-shopping-cart text-blue"></i> <span> Sales </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('sale')">
                                <li class="@yield('sale_order_manage')">
                                    <a href="{{ route('sale_orders') }}"><i class="fa fa-space-shuttle"></i> Manage
                                        sale </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('online_income')
                        <li class="treeview @yield('online_income')">
                            <a href="#">
                                <i class="fa fa-users text-blue"></i> <span> Other's Income </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('online_income')">
                                @can('others_income_add')
                                    <li class="@yield('online_income_add')">
                                        <a href="{{ route('online_income_add') }}"><i class="fa fa-space-shuttle"></i>
                                            Add
                                            Income</a>
                                    </li>
                                @endcan
                                <li class="@yield('online_income_manage')">
                                    <a href="{{ route('online_incomes') }}"><i class="fa fa-space-shuttle"></i>
                                        Manage
                                        Income</a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    @can('online_expense')
                        <li class="treeview @yield('online_expense')">
                            <a href="#">
                                <i class="fa fa-users text-blue"></i> <span> Other's Expense </span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('online_expense')">
                                @can('others_expense_add')
                                    <li class="@yield('online_expense_add')">
                                        <a href="{{ route('online_expense_add') }}"><i class="fa fa-space-shuttle"></i>
                                            Add
                                            Expense</a>
                                    </li>
                                @endcan
                                <li class="@yield('online_expense_manage')">
                                    <a href="{{ route('online_expenses') }}"><i class="fa fa-space-shuttle"></i>
                                        Manage
                                        Expense</a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    @can('accounts')
                        <li class="treeview @yield('accounts')">
                            <a href="#">
                                <i class="fa fa-tachometer text-info"></i> <span>Accounts</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu @yield('accounts')">
                                @can('account_head')
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-space-shuttle"></i> Account Head
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu" style="@yield('account_head')">
                                            @can('account_head_add')
                                                <li class="@yield('account_head_add')">
                                                    <a href="{{ route('account_head_add') }}"><i class="fa fa-plus-circle"></i>
                                                        Add Account Head</a>
                                                </li>
                                            @endcan

                                            <li class="@yield('account_head_manage')">
                                                <a href="{{ route('account_heads') }}"><i class="fa fa-th-list"></i> Manage
                                                    Account Head</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('account')
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-space-shuttle"></i> Account
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu" style="@yield('account')">
                                            @can('account_add')
                                                <li class="@yield('account_add')">
                                                    <a href="{{ route('account_add') }}"><i class="fa fa-plus-circle"></i> Add
                                                        Account </a>
                                                </li>
                                            @endcan

                                            <li class="@yield('account_manage')">
                                                <a href="{{ route('accounts') }}"><i class="fa fa-th-list"></i> Manage
                                                    Account </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('balance_transfer')
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-space-shuttle"></i> Balance Transfer
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu" style="@yield('balance_transfer')">
                                            @can('balance_transfer_add')
                                                <li class="@yield('balance_transfer_add')">
                                                    <a href="{{ route('balance_transfer_add') }}"><i
                                                            class="fa fa-plus-circle"></i> Add Balance Transfer </a>
                                                </li>
                                            @endcan

                                            <li class="@yield('balance_transfers')">
                                                <a href="{{ route('balance_transfers') }}"><i class="fa fa-th-list"></i>
                                                    Manage Balance Transfer </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('account_adjustment')
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-space-shuttle"></i> Account Adjustment
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu" style="@yield('account_adjustment')">
                                            @can('account_adjustment_add')
                                                <li class="@yield('account_adjustment_add')">
                                                    <a href="{{ route('account_adjustment_add') }}"><i
                                                            class="fa fa-plus-circle"></i> Add Adjustment </a>
                                                </li>
                                            @endcan

                                            <li class="@yield('account_adjustments')">
                                                <a href="{{ route('account_adjustments') }}"><i class="fa fa-th-list"></i>
                                                    Manage Adjustment </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                                @can('opening_balance')
                                    <li class="treeview">
                                        <a href="#"><i class="fa fa-space-shuttle"></i> Opening Balance
                                            <span class="pull-right-container">
                                                <i class="fa fa-angle-left pull-right"></i>
                                            </span>
                                        </a>
                                        <ul class="treeview-menu" style="@yield('opening_balance')">
                                            @can('employee_opening_add')
                                                <li class="@yield('employee_opening_balance_add')">
                                                    <a href="{{ route('employee_opening_balance_add') }}"><i
                                                            class="fa fa-plus-circle"></i> Employee opening </a>
                                                </li>
                                            @endcan
                                            @can('customer_opening_add')
                                                <li class="@yield('customer_opening_balance_add')">
                                                    <a href="{{ route('customer_opening_balance_add') }}"><i
                                                            class="fa fa-plus-circle"></i> Customer opening </a>
                                                </li>
                                            @endcan
                                            @can('supplier_opening_add')
                                                <li class="@yield('supplier_opening_balance_add')">
                                                    <a href="{{ route('supplier_opening_balance_add') }}"><i
                                                            class="fa fa-plus-circle"></i> Supplier opening </a>
                                                </li>
                                            @endcan
                                            @can('bank_opening_add')
                                                <li class="@yield('bank_opening_balance_add')">
                                                    <a href="{{ route('bank_opening_balance_add') }}"><i
                                                            class="fa fa-plus-circle"></i> Bank opening </a>
                                                </li>
                                            @endcan
                                            @can('account_opening_add')
                                                <li class="@yield('opening_balance_add')">
                                                    <a href="{{ route('opening_balance_add') }}"><i
                                                            class="fa fa-plus-circle"></i> Account opening </a>
                                                </li>
                                            @endcan

                                            <li class="@yield('opening_balances')">
                                                <a href="{{ route('opening_balances') }}"><i class="fa fa-th-list"></i>
                                                    Manage opening balance </a>
                                            </li>
                                        </ul>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    @can('report')
                        <li class="treeview @yield('report')">
                            <a href="#">
                                <i class="fa fa-indent text-info"></i> <span>Report</span>
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-left pull-right"></i>
                                </span>
                            </a>
                            <ul class="treeview-menu  @yield('report')">
                                @can('chart_of_account')
                                    <li class="@yield('report_chart_of_accounts')">
                                        <a href="{{ route('report_chart_of_accounts') }}"><i class="fa fa-space-shuttle"></i>
                                            Chart of accounts </a>
                                    </li>
                                @endcan
                                @can('trial_balance')
                                    <li class="@yield('report_trial_balance')">
                                        <a href="{{ route('report_trial_balance') }}"><i class="fa fa-space-shuttle"></i>
                                            Trial Balance </a>
                                    </li>
                                @endcan
                                @can('ledger')
                                    <li class="@yield('report_ledger')">
                                        <a href="{{ route('report_ledger') }}"><i class="fa fa-space-shuttle"></i>
                                            Ledger </a>
                                    </li>
                                @endcan
                                @can('cash_bank_statement')
                                    <li class="@yield('report_cash_bank_statement')">
                                        <a href="{{ route('report_cash_bank_statement') }}"><i
                                                class="fa fa-space-shuttle"></i>
                                            Cash & Bank Statement </a>
                                    </li>
                                @endcan

                                @can('salary_sheet')
                                    <li class="@yield('report_salary_sheet')">
                                        <a href="{{ route('report_salary_sheet') }}"><i class="fa fa-space-shuttle"></i>
                                            Salary Sheet </a>
                                    </li>
                                @endcan
                                @can('supplier_report')
                                    <li class="@yield('report_supplier')">
                                        <a href="{{ route('report_supplier') }}"><i class="fa fa-space-shuttle"></i>
                                            Supplier Report </a>
                                    </li>
                                @endcan
                                @can('supplier_due_report')
                                    <li class="@yield('report_supplier_due')">
                                        <a href="{{ route('report_supplier_due') }}"><i class="fa fa-space-shuttle"></i>
                                            Supplier Due Report </a>
                                    </li>
                                @endcan
                                @can('customer_report')
                                    <li class="@yield('report_customer')">
                                        <a href="{{ route('report_customer') }}"><i class="fa fa-space-shuttle"></i>
                                            Customer Report </a>
                                    </li>
                                @endcan
                                @can('customer_due_report')
                                    <li class="@yield('report_customer_due')">
                                        <a href="{{ route('report_customer_due') }}"><i class="fa fa-space-shuttle"></i>
                                            Customer Due Report </a>
                                    </li>
                                @endcan
                                @can('report_purchase')
                                    <li class="@yield('report_purchase')">
                                        <a href="{{ route('report_purchase') }}"><i class="fa fa-space-shuttle"></i>
                                            Purchase Report </a>
                                    </li>
                                @endcan


                            </ul>
                        </li>
                    @endcan


                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @yield('title')
                </h1>
            </section>

            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Design & Developed By <a target="_blank" href="https://www.onepointitbd.com/"> ONE POINT IT
                        SOLUTION
                    </a></b>
            </div>
            <strong>Copyright &copy; {{ date('Y') }} <a
                    href="{{ route('dashboard') }}">{{ config('app.name') }}</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="{{ asset('themes/backend/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('themes/backend/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    @yield('script')
    <!-- AdminLTE App -->
    <script src="{{ asset('themes/backend/js/adminlte.min.js') }}"></script>
</body>

</html>
