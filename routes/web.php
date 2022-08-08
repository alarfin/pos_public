<?php



Auth::routes(['register' => false, 'reset' => false]);

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    // Setting
    Route::get('setting/add', 'SettingController@add')->name('setting_add')->middleware('permission:setting');
    Route::post('setting/add', 'SettingController@store')->name('setting')->middleware('permission:setting');

    // Company Branch
    Route::get('company-branches', 'CompanyBranchController@index')->name('company_branches')->middleware('permission:company_branch');
    Route::get('company-branch-datatable', 'CompanyBranchController@companyBranchDatatable')->name('company_branch_datatable')->middleware('permission:company_branch');
    Route::get('company-branch/add', 'CompanyBranchController@add')->name('company_branch_add')->middleware('permission:company_branch_add');
    Route::post('company-branch/add', 'CompanyBranchController@addPost')->middleware('permission:company_branch_add');
    Route::get('company-branch/edit/{company_branch}', 'CompanyBranchController@edit')->name('company_branch_edit')->middleware('permission:company_branch_edit');
    Route::post('company-branch/edit/{company_branch}', 'CompanyBranchController@editPost')->middleware('permission:company_branch_edit');
    Route::get('company-branch/delete/{company_branch}', 'CompanyBranchController@delete')->name('company_branch_delete')->middleware('permission:company_branch_delete');

    // Bank
    Route::get('bank', 'BankController@index')->name('bank')->middleware('permission:bank');
    Route::get('bank/add', 'BankController@add')->name('bank_add')->middleware('permission:bank_add');
    Route::post('bank/add', 'BankController@addPost')->middleware('permission:bank_add');
    Route::get('bank/edit/{bank}', 'BankController@edit')->name('bank_edit')->middleware('permission:bank_edit');
    Route::post('bank/edit/{bank}', 'BankController@editPost')->middleware('permission:bank_edit');
    Route::get('bank/delete/{bank}', 'BankController@delete')->name('bank_delete')->middleware('permission:bank_delete');

    // Supplier
    Route::get('supplier', 'SupplierController@index')->name('supplier')->middleware('permission:supplier');
    Route::get('supplier-datatable', 'SupplierController@supplierDatatable')->name('supplier_datatable')->middleware('permission:supplier');
    Route::get('supplier/add', 'SupplierController@add')->name('supplier_add')->middleware('permission:supplier_add');
    Route::post('supplier/add', 'SupplierController@store')->middleware('permission:supplier_add');
    Route::get('supplier/edit/{supplier}', 'SupplierController@edit')->name('supplier_edit')->middleware('permission:supplier_edit');
    Route::post('supplier/edit/{supplier}', 'SupplierController@update')->middleware('permission:supplier_edit');
    Route::get('supplier/delete/{supplier}', 'supplierController@delete')->name('supplier_delete')->middleware('permission:supplier_delete');

    /*********************
     * Human Resouce (HR)
     */

    // Desingation
    Route::get('designations', 'DesignationController@index')->name('designations')->middleware('permission:designation');
    Route::get('designation-datatable', 'DesignationController@designationDatatable')->name('designation_datatable')->middleware('permission:designation');
    Route::get('designation/add', 'DesignationController@add')->name('designation_add')->middleware('permission:designation_add');
    Route::post('designation/add', 'DesignationController@store')->middleware('permission:designation_add');
    Route::get('designation/edit/{designation}', 'DesignationController@edit')->name('designation_edit')->middleware('permission:designation_edit');
    Route::post('designation/edit/{designation}', 'DesignationController@update')->middleware('permission:designation_edit');
    Route::get('designation/delete/{designation}', 'DesignationController@delete')->name('designation_delete')->middleware('permission:designation_delete');

    // Employee
    Route::get('employees', 'EmployeeController@index')->name('employees')->middleware('permission:employee');
    Route::get('employee-datatable', 'EmployeeController@employeeDatatable')->name('employee_datatable')->middleware('permission:employee');
    Route::get('employee/add', 'EmployeeController@add')->name('employee_add')->middleware('permission:employee_add');
    Route::post('employee/add', 'EmployeeController@store')->middleware('permission:employee_add');
    Route::get('employee/edit/{employee}', 'EmployeeController@edit')->name('employee_edit')->middleware('permission:employee_edit');
    Route::post('employee/edit/{employee}', 'EmployeeController@update')->middleware('permission:employee_edit');
    Route::get('employee/details/{employee}', 'EmployeeController@details')->name('employee_details')->middleware('permission:employee');
    Route::get('employee/delete/{employee}', 'EmployeeController@delete')->name('employee_delete')->middleware('permission:employee_delete');

    // Employee Attendance
    Route::get('attendances', 'AttendanceController@index')->name('attendances')->middleware('permission:employee_attendance');
    Route::get('attendance-datatable', 'AttendanceController@attendanceDatatable')->name('attendance_datatable')->middleware('permission:employee_attendance');
    Route::get('attendance/add', 'AttendanceController@add')->name('attendance_add')->middleware('permission:employee_attendance_add');
    Route::post('attendance/add', 'AttendanceController@store')->middleware('permission:employee_attendance_add');
    Route::get('attendance/edit/{attendance}', 'AttendanceController@edit')->name('attendance_edit')->middleware('permission:employee_attendance_edit');
    Route::post('attendance/edit/{attendance}', 'AttendanceController@update')->middleware('permission:employee_attendance_edit');
    Route::get('attendance/details/{attendance}', 'AttendanceController@details')->name('attendance_details')->middleware('permission:employee_attendance');
    Route::get('attendance/delete/{attendance}', 'AttendanceController@delete')->name('attendance_delete')->middleware('permission:employee_attendance_delete');

    // Salary Process
    Route::get('salary-processes', 'SalaryProcessController@index')->name('salary_processes')->middleware('permission:salary_process');
    Route::get('salary-process-datatable', 'SalaryProcessController@salaryProcessDatatable')->name('salary_process_datatable')->middleware('permission:salary_process');
    Route::get('salary-process/add', 'SalaryProcessController@add')->name('salary_process_add')->middleware('permission:salary_process_add');
    Route::post('salary-process/add', 'SalaryProcessController@store')->middleware('permission:salary_process_add');
    Route::get('salary-process/edit/{salary_process}', 'SalaryProcessController@edit')->name('salary_process_edit')->middleware('permission:salary_process_edit');
    Route::post('salary-process/edit/{salary_process}', 'SalaryProcessController@update')->middleware('permission:salary_process_edit');
    Route::get('salary-process/details/{salary_process}', 'SalaryProcessController@details')->name('salary_process_details')->middleware('permission:salary_process');
    Route::get('salary-process/delete/{salary_process}', 'SalaryProcessController@delete')->name('salary_process_delete')->middleware('permission:salary_process_delete');


    // Customer
    Route::get('customer', 'CustomerController@index')->name('customer')->middleware('permission:customer');
    Route::get('customer/add', 'CustomerController@add')->name('customer_add')->middleware('permission:customer_add');
    Route::post('customer/add', 'CustomerController@addPost')->middleware('permission:customer_add');
    Route::get('customer/edit/{customer}', 'CustomerController@edit')->name('customer_edit')->middleware('permission:customer_edit');
    Route::post('customer/edit/{customer}', 'CustomerController@editPost')->middleware('permission:customer_edit');
    Route::get('customer/datatable', 'CustomerController@customerDatatable')->name('customer_datatable')->middleware('permission:customer');
    Route::get('customer/delete/{customer}', 'customerController@delete')->name('customer_delete')->middleware('permission:customer_delete');

    Route::post('store-new-customer', 'customerController@storeCustomer')->name('store_new_customer')->middleware('permission:customer_add');


    // Product Unit
    Route::get('product-units', 'ProductUnitController@index')->name('product_units')->middleware('permission:product_unit');
    Route::get('product-unit-datatble', 'ProductUnitController@productDatatable')->name('product_unit_datatable')->middleware('permission:product_unit');
    Route::get('product-unit/add', 'ProductUnitController@add')->name('product_unit_add')->middleware('permission:product_unit_add');
    Route::post('product-unit/add', 'ProductUnitController@store')->middleware('permission:product_unit_add');
    Route::get('product-unit/edit/{product_unit}', 'ProductUnitController@edit')->name('product_unit_edit')->middleware('permission:product_unit_edit');
    Route::post('product-unit/edit/{product_unit}', 'ProductUnitController@update')->middleware('permission:product_unit_edit');
    Route::get('product-unit/delete/{product_unit}', 'ProductUnitController@delete')->name('product_unit_delete')->middleware('permission:product_unit_delete');

    // Product Brand
    Route::get('product-brands', 'ProductBrandController@index')->name('product_brands')->middleware('permission:product_brand');
    Route::get('product-brand-datatble', 'ProductBrandController@productDatatable')->name('product_brand_datatable')->middleware('permission:product_brand');
    Route::get('product-brand/add', 'ProductBrandController@add')->name('product_brand_add')->middleware('permission:product_brand_add');
    Route::post('product-brand/add', 'ProductBrandController@store')->middleware('permission:product_brand_add');
    Route::get('product-brand/edit/{product_brand}', 'ProductBrandController@edit')->name('product_brand_edit')->middleware('permission:product_brand_edit');
    Route::post('product-brand/edit/{product_brand}', 'ProductBrandController@update')->middleware('permission:product_brand_edit');
    Route::get('product-brand/delete/{product_brand}', 'ProductBrandController@delete')->name('product_brand_delete')->middleware('permission:product_brand_delete');

    // Product Category
    Route::get('product-categories', 'ProductCategoryController@index')->name('product_categories')->middleware('permission:product_category');
    Route::get('product-category-datatble', 'ProductCategoryController@productDatatable')->name('product_category_datatable')->middleware('permission:product_category');
    Route::get('product-category/add', 'ProductCategoryController@add')->name('product_category_add')->middleware('permission:product_category_add');
    Route::post('product-category/add', 'ProductCategoryController@store')->middleware('permission:product_category_add');
    Route::get('product-category/edit/{product_category}', 'ProductCategoryController@edit')->name('product_category_edit')->middleware('permission:product_category_edit');
    Route::post('product-category/edit/{product_category}', 'ProductCategoryController@update')->middleware('permission:product_category_edit');
    Route::get('product-category/delete/{product_category}', 'ProductCategoryController@delete')->name('product_category_delete')->middleware('permission:product_category_delete');

    // Product Unit
    Route::get('product-colors', 'ProductColorController@index')->name('product_colors');
    Route::get('product-color-datatble', 'ProductColorController@productDatatable')->name('product_color_datatable');
    Route::get('product-color/add', 'ProductColorController@add')->name('product_color_add');
    Route::post('product-color/add', 'ProductColorController@store');
    Route::get('product-color/edit/{product_color}', 'ProductColorController@edit')->name('product_color_edit');
    Route::post('product-color/edit/{product_color}', 'ProductColorController@update');
    Route::get('product-color/delete/{product_color}', 'ProductColorController@delete')->name('product_color_delete');

    // Product Size
    Route::get('sizes', 'ProductSizeController@index')->name('product_sizes');
    Route::get('size-datatble', 'ProductSizeController@productDatatable')->name('product_size_datatable');
    Route::get('size/add', 'ProductSizeController@add')->name('product_size_add');
    Route::post('size/add', 'ProductSizeController@store');
    Route::get('size/edit/{product_size}', 'ProductSizeController@edit')->name('product_size_edit');
    Route::post('size/edit/{product_size}', 'ProductSizeController@update');
    Route::get('size/delete/{product_size}', 'ProductSizeController@delete')->name('product_size_delete');

    // Product
    Route::get('products', 'ProductController@index')->name('products')->middleware('permission:product');
    Route::get('product-datatble', 'ProductController@productDatatable')->name('product_datatable')->middleware('permission:product');
    Route::get('product/add', 'ProductController@add')->name('product_add')->middleware('permission:product_add');
    Route::post('product/add', 'ProductController@store')->middleware('permission:product_add');
    Route::get('product/edit/{product}', 'ProductController@edit')->name('product_edit')->middleware('permission:product_edit');
    Route::post('product/edit/{product}', 'ProductController@update')->middleware('permission:product_edit');
    Route::get('product/delete/{product}', 'ProductController@delete')->name('product_delete')->middleware('permission:product_delete');
    Route::get('product/barcode-print', 'ProductController@barcodePrint')->name('product_barcode_print')->middleware('permission:product');
    Route::get('product/qrcode-print', 'ProductController@qrcodePrint')->name('product_qrcode_print')->middleware('permission:product');
    Route::post('store-new-product', 'ProductController@storeProduct')->name('store_new_product')->middleware('permission:product_add');

    // Damage Product
    Route::get('product-damages', 'ProductDamageController@productDamages')->name('product_damages')->middleware('permission:product_damage');
    Route::get('product-damage-datatable', 'ProductDamageController@productDamageDatatable')->name('product_damage_datatable')->middleware('permission:product_damage');
    Route::get('product-damage-create', 'ProductDamageController@productDamageCreate')->name('product_damage_create')->middleware('permission:product_damage_add');
    Route::post('product-damage-create', 'ProductDamageController@productDamageStore')->middleware('permission:product_damage_add');
    Route::get('product-damage-delete/{inventory_log}', 'ProductDamageController@productDamageDelete')->name('product_damage_delete')->middleware('permission:product_damage_delete');

    // Inventory
    Route::get('inventory', 'InventoryController@inventory')->name('inventory')->middleware('permission:product_inventory');
    Route::get('inventory-datatable', 'InventoryController@inventoryDatatable')->name('inventory_datatable')->middleware('permission:product_inventory');
    Route::get('inventory-details', 'InventoryController@inventoryDetails')->name('inventory_details')->middleware('permission:product_inventory_details');
    Route::get('inventory-details-datatable', 'InventoryController@inventoryDetailsDatatable')->name('inventory_details_datatable')->middleware('permission:product_inventory_details');


    // Purchase Order
    Route::get('purchase-orders', 'PurchaseController@purchaseOrders')->name('purchase_orders')->middleware('permission:purchase');
    Route::get('purchase-order-datatable', 'PurchaseController@purchaseOrderDatatable')->name('purchase_order_datatable')->middleware('permission:purchase');
    Route::get('purchase-order-create', 'PurchaseController@purchaseOrderCreate')->name('purchase_order_create')->middleware('permission:purchase_add');
    Route::post('purchase-order-create', 'PurchaseController@purchaseOrderStore')->middleware('permission:purchase_add');
    Route::get('purchase-order-edit/{purchase_order}', 'PurchaseController@purchaseOrderEdit')->name('purchase_order_edit')->middleware('permission:purchase_edit');
    Route::post('purchase-order-edit/{purchase_order}', 'PurchaseController@purchaseOrderUpdate')->middleware('permission:purchase_edit');
    Route::get('purchase-order-details/{purchase_order}', 'PurchaseController@purchaseOrderDetails')->name('purchase_order_details')->middleware('permission:purchase');
    Route::get('purchase-order-print/{purchase_order}', 'PurchaseController@purchaseOrderPrint')->name('purchase_order_print')->middleware('permission:purchase');
    Route::post('purchase-order-payment', 'PurchaseController@purchaseOrderPayment')->name('purchase_order_payment')->middleware('permission:supplier_payment');

    // Purchase Return
    Route::get('purchase-product-return', 'ReturnController@purchaseReturn')->name('purchase_return')->middleware('permission:purchase_return');
    Route::post('purchase-product-return', 'ReturnController@purchaseReturnStore')->middleware('permission:purchase_return');

    // Price Quotation
    Route::get('price-quotations', 'PriceQuotationController@priceQuotations')->name('price_quotations')->middleware('permission:price_quotation');
    Route::get('price-quotation-datatable', 'PriceQuotationController@priceQuotationDatatable')->name('price_quotation_datatable')->middleware('permission:price_quotation');
    Route::get('price-quotation-create', 'PriceQuotationController@priceQuotationCreate')->name('price_quotation_create')->middleware('permission:price_quotation_add');
    Route::post('price-quotation-create', 'PriceQuotationController@priceQuotationStore')->middleware('permission:price_quotation_add');
    Route::get('price-quotation-edit/{price_quotation}', 'PriceQuotationController@priceQuotationEdit')->name('price_quotation_edit')->middleware('permission:price_quotation_edit');
    Route::post('price-quotation-edit/{price_quotation}', 'PriceQuotationController@priceQuotationUpdate')->middleware('permission:price_quotation_edit');
    Route::get('price-quotation-delete/{price_quotation}', 'PriceQuotationController@priceQuotationDelete')->name('price_quotation_delete')->middleware('permission:price_quotation_delete');
    Route::get('price-quotation-details/{price_quotation}', 'PriceQuotationController@priceQuotationDetails')->name('price_quotation_details')->middleware('permission:price_quotation');
    Route::get('price-quotation-print/{price_quotation}', 'PriceQuotationController@priceQuotationPrint')->name('price_quotation_print')->middleware('permission:price_quotation');

    // Sale Order
    Route::get('sale-orders', 'SaleController@saleOrders')->name('sale_orders')->middleware('permission:sale');
    Route::get('sale-order-datatable', 'SaleController@saleOrderDatatable')->name('sale_order_datatable')->middleware('permission:sale');
    Route::get('sale-order-create', 'SaleController@saleOrderCreate')->name('sale_order_create')->middleware('permission:sale_add');
    Route::post('sale-order-create', 'SaleController@saleOrderStore')->middleware('permission:sale_add');
    Route::get('sale-order-edit/{sale_order}', 'SaleController@saleOrderEdit')->name('sale_order_edit')->middleware('permission:sale_edit');
    Route::post('sale-order-edit/{sale_order}', 'SaleController@saleOrderUpdate')->middleware('permission:sale_edit');
    Route::get('sale-order-delete/{sale_order}', 'SaleController@saleOrderDelete')->name('sale_order_delete')->middleware('permission:sale_delete');
    Route::get('sale-order-details/{sale_order}', 'SaleController@saleOrderDetails')->name('sale_order_details')->middleware('permission:sale');
    Route::get('sale-order-print/{sale_order}', 'SaleController@saleOrderPrint')->name('sale_order_print')->middleware('permission:sale');
    Route::post('sale-order-payment', 'SaleController@saleOrderPayment')->name('sale_order_payment')->middleware('permission:customer_payment');

    // Sale Return
    Route::get('sale-product-return', 'ReturnController@saleReturn')->name('sale_return')->middleware('permission:sale_return');
    Route::post('sale-product-return', 'ReturnController@saleReturnStore')->middleware('permission:sale_return');

    // Product Transfer
    Route::get('product-transfers', 'ProductTransferController@productTransfers')->name('product_transfers')->middleware('permission:product_transfers');
    Route::get('product-transfer-datatable', 'ProductTransferController@productTransferDatatable')->name('product_transfer_datatable')->middleware('permission:product_transfers');
    Route::get('product-transfer-create', 'ProductTransferController@productTransferCreate')->name('product_transfer_create')->middleware('permission:product_transfer_create');
    Route::post('product-transfer-create', 'ProductTransferController@productTransferStore')->middleware('permission:product_transfer_create');
    Route::get('product-transfer-delete/{product_transfer}', 'ProductTransferController@productTransferDelete')->name('product_transfer_delete')->middleware('permission:product_transfer_delete');

    // Online Income
    Route::get('online-incomes', 'OnlineIncomeController@index')->name('online_incomes')->middleware('permission:others_income');
    Route::get('online-incomes-datatable', 'OnlineIncomeController@onlineincomeDatatable')->name('online_incomes_datatable')->middleware('permission:others_income');
    Route::get('online-income/add', 'OnlineIncomeController@add')->name('online_income_add')->middleware('permission:others_income_add');
    Route::post('online-income/add', 'OnlineIncomeController@store')->middleware('permission:others_income_add');
    Route::get('online-income/details/{online_income}', 'OnlineIncomeController@details')->name('online_income_details')->middleware('permission:others_income');
    Route::get('online-income/edit/{online_income}', 'OnlineIncomeController@edit')->name('online_income_edit')->middleware('permission:others_income_edit');
    Route::post('online-income/edit/{online_income}', 'OnlineIncomeController@update')->middleware('permission:others_income_edit');
    Route::get('online-income/delete/{online_income}', 'OnlineIncomeController@delete')->name('online_income_delete')->middleware('permission:others_income_add');

    // Online Expense
    Route::get('online-expenses', 'OnlineExpenseController@index')->name('online_expenses')->middleware('permission:others_expense');
    Route::get('online-expenses-datatable', 'OnlineExpenseController@onlineexpenseDatatable')->name('online_expenses_datatable')->middleware('permission:others_expense');
    Route::get('online-expense/add', 'OnlineExpenseController@add')->name('online_expense_add')->middleware('permission:others_expense_add');
    Route::post('online-expense/add', 'OnlineExpenseController@store')->middleware('permission:others_expense_add');
    Route::get('online-expense/details/{online_expense}', 'OnlineExpenseController@details')->name('online_expense_details')->middleware('permission:others_expense');
    Route::get('online-expense/edit/{online_expense}', 'OnlineExpenseController@edit')->name('online_expense_edit')->middleware('permission:others_expense_edit');
    Route::post('online-expense/edit/{online_expense}', 'OnlineExpenseController@update')->middleware('permission:others_expense_edit');
    Route::get('online-expense/delete/{online_expense}', 'OnlineExpenseController@delete')->name('online_expense_delete')->middleware('permission:others_expense_delete');

    /******************
     *  Account System
     */
    // Account Head
    Route::get('account-heads', 'AccountHeadController@index')->name('account_heads')->middleware('permission:account_head');
    Route::get('account-heads-datatable', 'AccountHeadController@accountHeadsDatatable')->name('account_heads_datatable')->middleware('permission:account_head');
    Route::get('account-head/add', 'AccountHeadController@add')->name('account_head_add')->middleware('permission:account_head_add');
    Route::post('account-head/add', 'AccountHeadController@store')->middleware('permission:account_head_add');
    Route::get('account-head/edit/{account_head}', 'AccountHeadController@edit')->name('account_head_edit')->middleware('permission:account_head_edit');
    Route::post('account-head/edit/{account_head}', 'AccountHeadController@update')->middleware('permission:account_head_edit');
    Route::get('account-head/delete/{account_head}', 'AccountHeadController@delete')->name('account_head_delete')->middleware('permission:account_head_delete');

    // Account
    Route::get('accounts', 'AccountController@index')->name('accounts')->middleware('permission:account');
    Route::get('accounts-datatable', 'AccountController@accountsDatatable')->name('accounts_datatable')->middleware('permission:account');
    Route::get('account/add', 'AccountController@add')->name('account_add')->middleware('permission:account_add');
    Route::post('account/add', 'AccountController@store')->middleware('permission:account_add');
    Route::get('account/edit/{account}', 'AccountController@edit')->name('account_edit')->middleware('permission:account_edit');
    Route::post('account/edit/{account}', 'AccountController@update')->middleware('permission:account_edit');
    Route::get('account/delete/{account}', 'AccountController@delete')->name('account_delete')->middleware('permission:account_delete');


    // Debit voucher
    Route::get('debit-transactions', 'AccountTransactionController@debitTransactions')->name('debit_transactions')->middleware('permission:debit_transaction');
    Route::get('debit-transaction-datatable', 'AccountTransactionController@debitTransactionDatatable')->name('debit_transaction_datatable')->middleware('permission:debit_transaction');
    Route::get('employee-debit-transaction/add', 'AccountTransactionController@employeeDebitTransactionAdd')->name('employee_debit_transaction_add')->middleware('permission:employee_debit_transaction_add');
    Route::get('supplier-debit-transaction/add', 'AccountTransactionController@supplierDebitTransactionAdd')->name('supplier_debit_transaction_add')->middleware('permission:supplier_debit_transaction_add');
    Route::get('debit-transaction/add', 'AccountTransactionController@debitTransactionAdd')->name('debit_transaction_add')->middleware('permission:debit_transaction_add');
    Route::post('debit-transaction/add', 'AccountTransactionController@debitTransactionStore')->middleware('permission:debit_transaction');
    Route::get('debit-transaction/details/{transaction}', 'AccountTransactionController@debitTransactionDetails')->name('debit_transaction_details')->middleware('permission:debit_transaction');

    // Credit voucher
    Route::get('credit-transactions', 'AccountTransactionController@creditTransactions')->name('credit_transactions')->middleware('permission:credit_transaction');
    Route::get('credit-transaction-datatable', 'AccountTransactionController@creditTransactionDatatable')->name('credit_transaction_datatable')->middleware('permission:credit_transaction');
    Route::get('employee-credit-transaction/add', 'AccountTransactionController@employeeCreditTransactionAdd')->name('employee_credit_transaction_add')->middleware('permission:employee_credit_transaction_add');
    Route::get('supplier-credit-transaction/add', 'AccountTransactionController@supplierCreditTransactionAdd')->name('supplier_credit_transaction_add')->middleware('permission:supplier_credit_transaction_add');
    Route::get('credit-transaction/add', 'AccountTransactionController@creditTransactionAdd')->name('credit_transaction_add')->middleware('permission:credit_transaction_add');
    Route::post('credit-transaction/add', 'AccountTransactionController@creditTransactionStore')->middleware('permission:credit_transaction');
    Route::get('credit-transaction/details/{transaction}', 'AccountTransactionController@creditTransactionDetails')->name('credit_transaction_details')->middleware('permission:credit_transaction');

    // Balance Transfer
    Route::get('balance-transfers', 'BalanceTransferController@balanceTransfers')->name('balance_transfers')->middleware('permission:balance_transfer');
    Route::get('balance-transfer-datatable', 'BalanceTransferController@balanceTransferDatatable')->name('balance_transfer_datatable')->middleware('permission:balance_transfer');
    Route::get('balance-transfer/add', 'BalanceTransferController@balanceTransferAdd')->name('balance_transfer_add')->middleware('permission:balance_transfer_add');
    Route::post('balance-transfer/add', 'BalanceTransferController@balanceTransferStore')->middleware('permission:balance_transfer_add');
    Route::get('balance-transfer/details/{balance_transfer}', 'BalanceTransferController@balanceTransferDetails')->name('balance_transfer_details')->middleware('permission:balance_transfer');

    // Adjustment voucher
    Route::get('account-adjustments', 'AccountAdjustmentController@accountAdjustments')->name('account_adjustments')->middleware('permission:account_adjustment');
    Route::get('account-adjustment-datatable', 'AccountAdjustmentController@accountAdjustmentDatatable')->name('account_adjustment_datatable')->middleware('permission:account_adjustment');
    Route::get('account-adjustment/add', 'AccountAdjustmentController@accountAdjustmentAdd')->name('account_adjustment_add')->middleware('permission:account_adjustment_add');
    Route::post('account-adjustment/add', 'AccountAdjustmentController@accountAdjustmentStore')->middleware('permission:account_adjustment_add');
    Route::get('account-adjustment/details/{transaction_log}', 'AccountAdjustmentController@accountAdjustmentDetails')->name('account_adjustment_details')->middleware('permission:account_adjustment');

    // Opening Balance
    Route::get('opening-balances', 'OpeningBalanceController@openingBalances')->name('opening_balances')->middleware('permission:opening_balance');
    Route::get('opening-balance-datatable', 'OpeningBalanceController@openingBalanceDatatable')->name('opening_balance_datatable')->middleware('permission:opening_balance');
    Route::get('employee-opening-balance/add', 'OpeningBalanceController@employeeOpeningBalanceAdd')->name('employee_opening_balance_add')->middleware('permission:employee_opening_add');
    Route::get('customer-opening-balance/add', 'OpeningBalanceController@customerOpeningBalanceAdd')->name('customer_opening_balance_add')->middleware('permission:customer_opening_add');
    Route::get('supplier-opening-balance/add', 'OpeningBalanceController@supplierOpeningBalanceAdd')->name('supplier_opening_balance_add')->middleware('permission:supplier_opening_add');
    Route::get('bank-opening-balance/add', 'OpeningBalanceController@bankOpeningBalanceAdd')->name('bank_opening_balance_add')->middleware('permission:bank_opening_add');
    Route::get('opening-balance/add', 'OpeningBalanceController@openingBalanceAdd')->name('opening_balance_add')->middleware('permission:account_opening_add');
    Route::post('opening-balance/add', 'OpeningBalanceController@openingBalanceStore')->middleware('permission:opening_balance');
    Route::get('opening-balance/details/{transaction_log}', 'OpeningBalanceController@openingBalanceDetails')->name('opening_balance_details')->middleware('permission:opening_balance');

    Route::get('user', 'UserController@index')->name('user_all')->middleware('permission:user');
    Route::get('user-datatable', 'UserController@userDatatable')->name('user_datatable')->middleware('permission:user');
    Route::get('user/add', 'UserController@add')->name('user_add')->middleware('permission:user_add');
    Route::post('user/add', 'UserController@addPost')->middleware('permission:user_add');
    Route::get('user/edit/{user}', 'UserController@edit')->name('user_edit')->middleware('permission:user_edit');
    Route::post('user/edit/{user}', 'UserController@editPost')->middleware('permission:user_edit');

    // Report
    Route::group(['as' => 'report_'], function () {
        Route::get('chart-of-accounts', 'ReportController@chartOfAccounts')->name('chart_of_accounts')->middleware('permission:chart_of_account');
        Route::get('trial-balance', 'ReportController@trialBalance')->name('trial_balance')->middleware('permission:trial_balance');
        Route::get('salary-sheet', 'ReportController@salarySheet')->name('salary_sheet')->middleware('permission:salary_sheet');
        Route::get('supplier-report', 'ReportController@supplierReport')->name('supplier')->middleware('permission:supplier_report');
        Route::get('supplier-due-report', 'ReportController@supplierDueReport')->name('supplier_due')->middleware('permission:supplier_due_report');
        Route::get('customer-report', 'ReportController@customerReport')->name('customer')->middleware('permission:customer_report');
        Route::get('customer-due-report', 'ReportController@customerDueReport')->name('customer_due')->middleware('permission:customer_due_report');
        Route::get('ledger', 'ReportController@ledgerReport')->name('ledger')->middleware('permission:ledger');
        Route::get('cash-bank-statements', 'ReportController@cashBankStatement')->name('cash_bank_statement')->middleware('permission:cash_bank_statement');
        Route::get('purchase-report', 'ReportController@purchaseReport')->name('purchase')->middleware('permission:report_purchase');
        Route::get('purchase-product-report', 'ReportController@purchaseProductReport')->name('purchase_product')->middleware('permission:report_purchase_product');
        Route::get('purchase-product-return-report', 'ReportController@purchaseProductReturnReport')->name('purchase_product_return')->middleware('permission:report_purchase_product_return');
        Route::get('sale-report', 'ReportController@saleReport')->name('sale')->middleware('permission:report_sale');
        Route::get('sale-product-report', 'ReportController@saleProductReport')->name('sale_product')->middleware('permission:report_sale_product');
        Route::get('sale-product-return-report', 'ReportController@saleProductReturnReport')->name('sale_product_return')->middleware('permission:report_sale_product_return');
        Route::get('stock', 'ReportController@stockReport')->name('stock')->middleware('permission:report_stock');
        Route::get('balance-summary', 'ReportController@balanceSummary')->name('balance_summary')->middleware('permission:daily_balance_summary');
        Route::get('sale-profit-loss', 'ReportController@saleProfitLoss')->name('sale_profit_loss')->middleware('permission:report_sale_profit_loss');
        Route::get('net-profit-loss', 'ReportController@netProfitLoss')->name('net_profit_loss')->middleware('permission:net_profit_loss');
    });

    // Common
    Route::get('order-details', 'CommonController@orderDetails')->name('get_order_details');
    Route::get('get-suppliers', 'CommonController@getsuppliers')->name('get_supplier');
    Route::get('get_customers', 'CommonController@getCustomers')->name('get_customers');
    Route::get('get-products-by-code', 'CommonController@getProductsByCode')->name('get_products_by_code');
    Route::get('get-sale-products-by-code', 'CommonController@getSaleProductsByCode')->name('get_sale_products_by_code');
    Route::get('get-products', 'CommonController@getProducts')->name('get_products');
    Route::get('get-product-details', 'CommonController@getProductDetails')->name('get_product_details');
    Route::get('get-employees', 'CommonController@getEmployees')->name('get_employees');
    Route::get('get-branch-employees', 'CommonController@getBranchEmployees')->name('get_branch_employees');
    Route::get('get-salary-month', 'CommonController@getSalaryMonth')->name('get_salary_month');
    Route::get('get-month-for-salary-sheet', 'CommonController@getMonthSalarySheet')->name('get_month_salary_sheet');
    Route::get('get-section-branch', 'CommonController@getSectionBranch')->name('get_section_branch');
    Route::get('get-course-details', 'CommonController@getCourseDetails')->name('get_course_details');
    Route::get('get-transfer-product', 'CommonController@getTransferProduct')->name('get_transfer_product');
    Route::get('get-branch-product-stock', 'CommonController@getBranchProductStock')->name('get_branch_product_stock');
});


Route::get('/test', function () {
    //
});
Route::get('query-test', 'CommonController@queryTest');
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});
