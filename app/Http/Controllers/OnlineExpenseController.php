<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\OnlineExpense;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OnlineExpenseController extends Controller
{
    public function index()
    {
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('online_expense.all', compact('banks'));
    }
    public function add()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)->where('account_class_id', 4)->where('status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('online_expense.add', compact('accounts', 'banks', 'branches'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'company_branch_id' => 'required',
            'date' => 'required|date',
            'account_id' => 'required',
            'payment_method' => 'required',
            'bank_id' => 'required_if:payment_method,=,2',
            'quantity' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $account = Account::find($request->account_id);

        $data = $request->all();
        $count = OnlineExpense::where('client_id', Auth::user()->client_id)->withTrashed()->count();

        $data['serial_no'] = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $data['client_id'] = Auth::user()->client_id;
        $data['account_head_id'] = $account->account_head_id;
        $data['user_id'] = Auth::id();
        $online_expense = OnlineExpense::create($data);

        // Online Information Credit
        $voucher_count = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        TransactionLog::create([
            'client_id' => Auth::user()->client_id,
            'company_branch_id' => $request->company_branch_id,
            'voucher_no' => str_pad($voucher_count + 1, 5, 0, STR_PAD_LEFT),
            'transaction_type' => 10,
            'date' => date('Y-m-d', strtotime($request->date)),
            'particular' => "Online expense for serial no. " . $online_expense->serial_no,
            'account_class_id' => $account->account_class_id,
            'account_head_id' => $account->account_head_id,
            'account_id' => $account->id,
            'customer_id' => null,
            'online_expense_id' => $online_expense->id,
            'payment_method' => null,
            'bank_id' => null,
            'credit' => $online_expense->amount,
            'amount' => $online_expense->amount,
            'note' => "Online Expense",
            'user_id' => Auth::id(),
            'status' => 1,
        ]);

        //  Receive payment
        if ($request->payment_method == 1) {
            $payment_account = Account::find(3);
        } elseif ($request->payment_method == 2) {
            $payment_account = Account::find(4);
        } else {
            $payment_account = Account::find(5);
        }

        $voucher_count2 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        TransactionLog::create([
            'client_id' => Auth::user()->client_id,
            'company_branch_id' => $request->company_branch_id,
            'voucher_no' => str_pad($voucher_count2 + 1, 5, 0, STR_PAD_LEFT),
            'transaction_type' => 1,
            'date' => date('Y-m-d', strtotime($request->date)),
            'particular' => "Online expense for serial no. " . $online_expense->serial_no,
            'account_class_id' => $payment_account->account_class_id,
            'account_head_id' => $payment_account->account_head_id,
            'account_id' => $payment_account->id,
            'customer_id' => null,
            'online_expense_id' => $online_expense->id,
            'payment_method' => $request->payment_method ?? null,
            'bank_id' => $request->bank_id ?? null,
            'credit' => $request->amount,
            'amount' => $request->amount,
            'note' => "Online Expense",
            'user_id' => Auth::id(),
            'status' => 1,
        ]);

        return redirect()->route('online_expenses')->with('message', 'Online expense added successfully.');
    }

    public function details(OnlineExpense $online_expense)
    {
        $this->clientCheck($online_expense);
        return view('online_expense.details', compact('online_expense'));
    }

    public function edit(OnlineExpense $online_expense)
    {
        $this->clientCheck($online_expense);
        $accounts = Account::where('client_id', Auth::user()->client_id)->where('account_class_id', 4)->where('status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();

        return view('online_expense.edit', compact('online_expense', 'accounts', 'banks', 'branches'));
    }

    public function update(Request $request, OnlineExpense $online_expense)
    {
        $this->clientCheck($online_expense);
        $old_account = Account::find($online_expense->account_id);
        $request->validate([
            'company_branch_id' => 'required',
            'date' => 'required|date',
            'account_id' => 'required',
            'payment_method' => 'required',
            'bank_id' => 'required_if:payment_method,=,2',
            'quantity' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);

        $account = Account::find($request->account_id);

        $data = $request->all();
        $data['account_head_id'] = $account->account_head_id;
        $online_expense->update($data);

        // Online Income Credit
        $transaction_log1 = TransactionLog::where('client_id', Auth::user()->client_id)->where('account_id', $old_account->id)->where('online_expense_id', $online_expense->id)->first();

        $transaction_log1->update([
            'date' => date('Y-m-d', strtotime($request->date)),
            'account_class_id' => $account->account_class_id,
            'account_head_id' => $account->account_head_id,
            'account_id' => $account->id,
            'credit' => $online_expense->amount,
            'amount' => $online_expense->amount,
        ]);

        //  Online income bank credit
        if ($request->payment_method == 1) {
            $payment_account = Account::find(3);
        } elseif ($request->payment_method == 2) {
            $payment_account = Account::find(4);
        } else {
            $payment_account = Account::find(5);
        }

        $transaction_log2 = TransactionLog::where('client_id', Auth::user()->client_id)->whereIn('account_id', [3, 4, 5, 6])->where('online_expense_id', $online_expense->id)->first();

        if ($transaction_log2) {
            $transaction_log2->update([
                'date' => date('Y-m-d', strtotime($request->date)),
                'account_class_id' => $payment_account->account_class_id,
                'account_head_id' => $payment_account->account_head_id,
                'account_id' => $payment_account->id,
                'credit' => $online_expense->amount,
                'amount' => $online_expense->amount,
            ]);
        }

        return redirect()->route('online_expenses')->with('message', 'Online information updated successfully.');
    }

    public function delete(OnlineExpense $online_expense)
    {
        $this->clientCheck($online_expense);
        TransactionLog::where('online_expense_id', $online_expense->id)->delete();
        $online_expense->delete();
        return redirect()->route('online_expenses')->with('message', 'Online income deleted successfully.');
    }

    public function OnlineExpenseDatatable(Request $request)
    {
        $query = OnlineExpense::with('companyBranch', 'account')->where('client_id', Auth::user()->client_id)->orderBy('id', 'desc');
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('company_branch_name', function (OnlineExpense $online_expense) {
                return $online_expense->companyBranch->name ?? '';
            })
            ->editColumn('date', function (OnlineExpense $online_expense) {
                return $online_expense->date->format('d-m-Y');
            })
            ->editColumn('status', function (OnlineExpense $online_expense) {
                if ($online_expense->status == 1) {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function (OnlineExpense $online_expense) {
                $btn = '';
                $btn .= ' <a href="' . route('online_expense_details', ['online_expense' => $online_expense->id]) . '" class="btn btn-info btn-sm">View</a> ';
                if (Auth::user()->can('online_expense_edit')) {
                    $btn .= ' <a href="' . route('online_expense_edit', ['online_expense' => $online_expense->id]) . '" class="btn btn-primary btn-sm"> Edit </a> ';
                }
                if (Auth::user()->can('online_expense_delete')) {
                    $btn .= ' <a href="' . route('online_expense_delete', ['online_expense' => $online_expense->id]) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete ?\');">Delete</a> ';
                }


                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
