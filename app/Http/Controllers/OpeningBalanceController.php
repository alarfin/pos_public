<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OpeningBalanceController extends Controller
{
    public function openingBalances()
    {
        return view('accounts.opening_balance.all');
    }

    public function employeeOpeningBalanceAdd()
    {
        $accounts = Account::whereIn('id', [7, 10])->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('accounts.opening_balance.employee_opening_add', compact('accounts', 'branches'));
    }

    public function customerOpeningBalanceAdd()
    {
        $accounts = Account::whereIn('id', [2, 11])->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('accounts.opening_balance.customer_opening_add', compact('accounts', 'branches'));
    }

    public function supplierOpeningBalanceAdd()
    {
        $accounts = Account::whereIn('id', [1])->get();
        $suppliers = Supplier::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('accounts.opening_balance.supplier_opening_add', compact('accounts', 'suppliers', 'branches'));
    }

    public function bankOpeningBalanceAdd()
    {
        $accounts = Account::whereIn('id', [4])->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('accounts.opening_balance.bank_opening_add', compact('accounts', 'banks', 'branches'));
    }

    public function openingBalanceAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->whereNotIn('id', [1, 2, 4, 7])->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('accounts.opening_balance.add', compact('accounts', 'branches'));
    }

    public function openingBalanceStore(Request $request)
    {
        $request->validate([
            'company_branch_id' => 'required',
            'date' => 'required|date',
            'type' => 'required|numeric',
            'employee' => 'required_if:type,==,2',
            'supplier_ids.*' => 'required_if:type,==,3',
            'bank_ids.*' => 'required_if:type,==,4',
            'customer' => 'required_if:type,==,5',
            'account_ids' => 'required',
            'account_ids.*' => 'required',
            'amounts.*' => 'required|numeric',
            'notes.*' => 'nullable'
        ]);

        $branch = CompanyBranch::find($request->company_branch_id);
        // Transaction Log
        foreach ($request->account_ids ?? [] as $key => $account_id) {
            $account = Account::find($account_id);
            $voucher_count = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            $employee_id = null;
            $customer_id = null;
            $supplier_id = null;
            $bank_id = null;
            $particular = $account->name . " opening balance";
            if ($request->type == 2) {
                $particular = Employee::find($request->employee)->name . " opening balance";
                $employee_id = $request->employee;
            }
            if ($request->type == 3) {
                $particular = Supplier::find($request->supplier_ids[$key])->name . " opening balance";
                $supplier_id = $request->supplier_ids[$key];
            }
            if ($request->type == 4) {
                $particular = Bank::find($request->bank_ids[$key])->name . " opening balance";
                $bank_id = $request->bank_ids[$key];
            }
            if ($request->type == 5) {
                $particular = Customer::find($request->customer)->name . " opening balance";
                $customer_id = $request->$request->customer;
            }
            $transaction_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($voucher_count + 1, 5, 0, STR_PAD_LEFT),
                'opening_status' => 1,
                'transaction_type' => 9,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => $particular,
                'account_class_id' => $account->account_class_id,
                'account_head_id' => $account->account_head_id,
                'account_id' => $account->id,
                'employee_id' => $employee_id,
                'customer_id' => $customer_id,
                'supplier_id' => $supplier_id,
                'bank_id' => $bank_id,
                'payment_method' => $bank_id ? 2 : null,
                'credit' => $request->amounts[$key],
                'amount' => $request->amounts[$key],
                'note' => $request->notes[$key],
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }

        return redirect()->route('opening_balances')->with('message', 'Opening balance added successfully done.');
    }

    public function openingBalanceDetails(TransactionLog $transaction_log)
    {
        return view('accounts.opening_balance.details', compact('transaction_log'));
    }

    public function openingBalanceDatatable()
    {
        $query = TransactionLog::with('account')->where('client_id', Auth::user()->client_id)->where('opening_status', 1);
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('opening_type', function (TransactionLog $transaction_log) {
                if ($transaction_log->employee_id) {
                    return "Employee opening";
                } elseif ($transaction_log->supplier_id) {
                    return "Supplier opening";
                } elseif ($transaction_log->bank_id) {
                    return "Bank opening";
                } else {
                    return "Account opening";
                }
            })
            ->addColumn('date', function (TransactionLog $transaction_log) {
                return $transaction_log->date->format('d-m-Y');
            })
            ->addColumn('action', function (TransactionLog $transaction_log) {
                $btn = ' <a href="' . route('opening_balance_details', ['transaction_log' => $transaction_log->id]) . '" class="btn btn-primary btn-sm"> Details </a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
