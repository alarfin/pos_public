<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountHeadSubType;
use App\Models\AccountHeadType;
use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\Cash;
use App\Models\CompanyBranch;
use App\Models\Customer;
use App\Models\MobileBanking;
use App\Models\Product;
use App\Models\PurchaseInventory;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderProduct;
use App\Models\PurchaseProduct;
use App\Models\SalaryProcess;
use App\Models\SaleOrder;
use App\Models\SaleOrderProduct;
use App\Models\SalesOrder;
use App\Models\Student;
use App\Models\Supplier;
use App\Models\TransactionLog;
use App\Models\Year;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function salarySheet(Request $request)
    {
        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');
        $salary_process = SalaryProcess::where('month', $month)->where('year', $year)->first();
        $branches = CompanyBranch::where('status', 1)->get();
        $years = Year::where('status', 1)->get();
        // dd($salary_process);
        return view('report.salary_sheet', compact('salary_process', 'years', 'branches'));
    }

    public function chartOfAccounts(Request $request)
    {
        $accounts = Account::where('status', 1)->get();
        $searchData = null;
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
        }
        if ($request->start_date && $request->end_date) {
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;
        }
        return view('report.chart_of_accounts', compact('accounts', 'searchData', 'company_branches'));
    }

    public function trialBalance(Request $request)
    {
        $accounts = Account::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $searchData = null;
        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
        }
        if ($request->start_date && $request->end_date) {
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;
        }
        return view('report.trial_balance', compact('accounts', 'searchData', 'company_branches'));
    }

    public function supplierReport(Request $request)
    {
        $suppliers = Supplier::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $searchData = null;
        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
        }
        if ($request->start_date && $request->end_date) {
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;
        }

        return view('report.supplier', compact('suppliers', 'company_branches', 'searchData'));
    }

    public function supplierDueReport(Request $request)
    {
        $suppliers = Supplier::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $searchData = null;
        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
        }
        if ($request->start_date && $request->end_date) {
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;
        }

        return view('report.supplier_due', compact('suppliers', 'company_branches', 'searchData'));
    }

    public function customerReport(Request $request)
    {
        $customers = Customer::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $searchData = null;
        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
        }
        if ($request->start_date && $request->end_date) {
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;
        }
        return view('report.customer', compact('customers', 'company_branches', 'searchData'));
    }

    public function customerDueReport(Request $request)
    {
        $customers = Customer::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $searchData = null;
        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
        }
        if ($request->start_date && $request->end_date) {
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;
        }
        return view('report.customer_due', compact('customers', 'company_branches', 'searchData'));
    }

    public function purchaseReport(Request $request)
    {
        $company_branches = $this->getCompanyBranches();
        $suppliers = Supplier::orderBy('name')->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');

        $query = PurchaseOrder::where('client_id', Auth::user()->client_id)->whereBetween('date', [$start_date, $end_date]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }

        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->invoice_no) {
            $query->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT));
        }
        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        $orders = $query->get();
        return view('report.purchase', compact('company_branches', 'orders', 'suppliers', 'start_date', 'end_date'));
    }

    public function purchaseProductReport(Request $request)
    {
        $company_branches = $this->getCompanyBranches();
        $suppliers = Supplier::orderBy('name')->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $products = Product::orderBy('name')->get();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');

        $query = PurchaseOrderProduct::where('client_id', Auth::user()->client_id)->whereBetween('date', [$start_date, $end_date]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }

        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->invoice_no) {
            $query->whereHas('purchaseOrder', function ($q) use ($request) {
                $q->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT));
            });
        }

        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        $orders = $query->get();
        return view('report.purchase_product', compact('company_branches', 'suppliers', 'orders', 'products', 'start_date', 'end_date'));
    }

    public function purchaseProductReturnReport(Request $request)
    {
        $company_branches = $this->getCompanyBranches();
        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');

        $query = PurchaseOrderProduct::where('client_id', Auth::user()->client_id)->where('return_quantity', '>', 0)->whereBetween('date', [$start_date, $end_date]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }

        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }

        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->invoice_no) {
            $query->whereHas('purchaseOrder', function ($q) use ($request) {
                $q->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT));
            });
        }

        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        $orders = $query->get();
        return view('report.purchase_product_return', compact('company_branches', 'suppliers', 'orders', 'products', 'start_date', 'end_date'));
    }

    public function saleReport(Request $request)
    {
        $company_branches = $this->getCompanyBranches();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');

        $query = SaleOrder::where('client_id', Auth::user()->client_id)->whereBetween('date', [$start_date, $end_date]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }

        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->invoice_no) {
            $query->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT));
        }
        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        $orders = $query->get();
        return view('report.sale', compact('company_branches', 'orders', 'start_date', 'end_date'));
    }

    public function saleProductReport(Request $request)
    {
        $company_branches = $this->getCompanyBranches();
        $products = Product::orderBy('name')->get();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');

        $query = SaleOrderProduct::where('client_id', Auth::user()->client_id)->whereBetween('date', [$start_date, $end_date]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }

        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->invoice_no) {
            $query->whereHas('saleOrder', function ($q) use ($request) {
                $q->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT));
            });
        }

        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        $orders = $query->get();
        return view('report.sale_product', compact('company_branches', 'orders', 'products', 'start_date', 'end_date'));
    }

    public function saleProductReturnReport(Request $request)
    {
        $company_branches = $this->getCompanyBranches();
        $products = Product::orderBy('name')->get();
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');

        $query = SaleOrderProduct::where('client_id', Auth::user()->client_id)->where('return_quantity', '>', 0)->whereBetween('date', [$start_date, $end_date]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }

        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->invoice_no) {
            $query->whereHas('saleOrder', function ($q) use ($request) {
                $q->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT));
            });
        }

        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        $orders = $query->get();
        return view('report.sale_product_return', compact('company_branches', 'orders', 'products', 'start_date', 'end_date'));
    }

    public function ledgerReport(Request $request)
    {
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');
        $accounts = Account::where('status', 1)->get();
        $suppliers = Supplier::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $show_data = null;

        $query = TransactionLog::orderBy('date', 'desc')->where('client_id', Auth::id())->where('status', 1)
            ->whereBetween('date', [$start_date, $end_date]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
            $show_data['company_branch'] = CompanyBranch::find($request->company_branch_id);
        }

        if ($request->account_id) {
            $query->where('account_id', $request->account_id);
            $show_data['account_id'] = Account::find($request->account_id);
        }

        if ($request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
            $show_data['supplier'] = Supplier::find($request->supplier_id);
        }

        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
            $show_data['customer'] = Customer::find($request->customer_id);
        }

        $ledgers = $query->orderBy('id', 'desc')->get();

        return view('report.ledger', compact('ledgers', 'accounts', 'suppliers', 'company_branches', 'start_date', 'end_date', 'show_data'));
    }

    public function cashBankStatement(Request $request)
    {
        $start_date = $request->start_date ?? date('Y-m-d');
        $end_date = $request->end_date ?? date('Y-m-d');
        $accounts = Account::whereIn('id', [3, 4])->get();
        $banks = Bank::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $show_data = null;

        $query = TransactionLog::orderBy('date', 'desc')->where('client_id', Auth::id())->where('status', 1)
            ->whereBetween('date', [$start_date, $end_date])->whereIn('account_id', [3, 4]);

        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
            $show_data['company_branch'] = CompanyBranch::find($request->company_branch_id);
        }

        if ($request->account_id) {
            $query->where('account_id', $request->account_id);
            $show_data['account'] = Account::find($request->account_id);
        }

        if ($request->bank_id) {
            $query->where('bank_id', $request->bank_id);
            $show_data['bank'] = Bank::find($request->bank_id);
        }

        $transaction_logs = $query->orderBy('id', 'desc')->get();

        return view('report.cash_bank_statement', compact('transaction_logs', 'banks', 'company_branches', 'accounts', 'start_date', 'end_date', 'show_data'));
    }

    public function stockReport(Request $request)
    {
        $products = Product::where('status', 1)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $show_data = null;
        $searchData = null;
        $searchData['start_date'] = $request->start_date ?? date('Y-m-d');
        $searchData['end_date'] = $request->end_date ?? date('Y-m-d');

        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
            $show_data['company_branch'] = CompanyBranch::find($request->company_branch_id);
        }

        return view('report.stock', compact('products', 'company_branches', 'searchData', 'show_data'));
    }

    public function balanceSummary(Request $request)
    {
        $cash_account = Account::find(3);
        $bank_account = Account::find(4);
        $capital_account = Account::find(6);
        $banks = Bank::where('client_id', Auth::user()->client_id)->get();
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $show_data = null;
        $searchData = null;
        $searchData['date'] = $request->date ?? date('Y-m-d');

        if ($request->company_branch_id) {
            $searchData['company_branch_id'] = $request->company_branch_id;
            $show_data['company_branch'] = CompanyBranch::find($request->company_branch_id);
        }

        return view('report.balance_summary', compact(
            'company_branches',
            'cash_account',
            'bank_account',
            'capital_account',
            'banks',
            'searchData',
            'show_data'
        ));
    }

    public function saleProfitLoss(Request $request)
    {
        $company_branches = $this->getCompanyBranches();
        $query = SaleOrder::where('client_id', Auth::user()->client_id);
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }
        if ($request->customer_id) {
            $query->where('customer_id', $request->customer_id);
        }

        $query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
        $sale_amount = $query->sum('total');
        $sale_tax = $query->sum('tax');
        $sale_vat = $query->sum('vat');
        $order_ids = $query->pluck('id');
        $buy_amount = SaleOrderProduct::whereIn('sale_order_id', $order_ids)->sum('buy_total');

        return view('report.sale_profit_loss', compact(
            'company_branches',
            'sale_amount',
            'buy_amount',
            'sale_tax',
            'sale_vat',
        ));
    }


    public function netProfitLoss(Request $request)
    {
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $searchData = null;
        $show_data = null;
        $pos = null;

        $pos_query = SaleOrder::where('client_id', Auth::user()->client_id);

        if ($request->company_branch_id) {
            $pos_query->where('company_branch_id', $request->company_branch_id);
            $searchData['company_branch_id'] = $request->company_branch_id;
            $show_data['company_branch'] = CompanyBranch::find($request->company_branch_id);
        }

        if ($request->start_date && $request->end_date) {
            $pos_query->whereBetween('date', [$request->start_date, $request->end_date]);
            $searchData['start_date'] = $request->start_date;
            $searchData['end_date'] = $request->end_date;
        }

        if (isset($pos_query)) {
            $pos_query->orderBy('date', 'desc')->orderBy('created_at', 'desc');
            $pos['sale_amount'] = $pos_query->sum('total');
            $pos['sale_tax'] = $pos_query->sum('tax');
            $pos['sale_vat'] = $pos_query->sum('vat');
            $order_ids = $pos_query->pluck('id');
            $pos['buy_amount'] = SaleOrderProduct::whereIn('sale_order_id', $order_ids)->sum('buy_total');
        }

        $income_accounts = Account::where('default_status', 1)->whereIn('account_class_id', [3])->orWhere(function ($q) {
            $q->where('client_id', Auth::user()->client_id)->whereIn('account_class_id', [3]);
        })->get();
        // dd($income_accounts);

        $expense_accounts = Account::where('default_status', 1)->whereIn('account_class_id', [4])->whereNotIn('id', [1])->orWhere(function ($q) {
            $q->where('client_id', Auth::user()->client_id)->whereIn('account_class_id', [4]);
        })->get();

        return view('report.net_profit_loss', compact(
            'company_branches',
            'searchData',
            'show_data',
            'pos',
            'income_accounts',
            'expense_accounts'
        ));
    }
}
