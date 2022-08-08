<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountHead;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\Employee;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AccountTransactionController extends Controller
{
    /******************
     *  Debit Transaction
     */

    public function debitTransactions()
    {
        return view('accounts.debit.all');
    }

    public function employeeDebitTransactionAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->where('transaction_status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 1)->withTrashed()->count();
        $transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('accounts.debit.employee_debit', compact('accounts', 'banks', 'branches', 'transaction_no'));
    }

    public function supplierDebitTransactionAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->where('transaction_status', 1)->get();
        $suppliers = Supplier::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 1)->withTrashed()->count();
        $transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('accounts.debit.supplier_debit', compact('accounts', 'suppliers', 'banks', 'branches', 'transaction_no'));
    }

    public function debitTransactionAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->where('transaction_status', 1)->get();

        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 1)->withTrashed()->count();
        $transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('accounts.debit.add', compact('accounts', 'banks', 'branches', 'transaction_no'));
    }

    public function debitTransactionStore(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'company_branch_id' => 'required',
            'date' => 'required|date',
            'payment_method' => 'required',
            'bank_id' => 'required_if:payment_method,==,2',
            'remark' => 'nullable',
            'account_ids' => 'required',
            'account_ids.*' => 'required',
            'employee' => 'required_if:type,==,2',
            'supplier' => 'required_if:type,==,3',
            'customer' => 'required_if:type,==,4',
            'amounts.*' => 'required|numeric',
            'notes.*' => 'nullable'
        ]);

        $branch = CompanyBranch::find($request->company_branch_id);
        // Transaction
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 1)->withTrashed()->count();
        $transaction = new Transaction();
        $transaction->client_id = Auth::user()->client_id;
        $transaction->company_branch_id = $branch->id;
        $transaction->transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $transaction->date = $request->date;
        $transaction->type = 1;
        $transaction->payment_method = $request->payment_method;
        $transaction->employee_id = $request->employee ?? null;
        $transaction->supplier_id = $request->supplier ?? null;
        $transaction->remark = $request->remark;
        $transaction->amount = array_sum($request->amounts ?? []);
        $transaction->user_id = Auth::id();
        $transaction->save();

        // Transaction Log
        foreach ($request->account_ids ?? [] as $key => $account_id) {
            $account = Account::find($account_id);
            $voucher_count1 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            $debit_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($voucher_count1 + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => 6,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Debit transaction for transaction no. " . $transaction->transaction_no,
                'account_class_id' => $account->account_class_id,
                'account_head_id' => $account->account_head_id,
                'account_id' => $account->id,
                'employee_id' => $request->employee ?? null,
                'supplier_id' => $request->supplier ?? null,
                'transaction_id' => $transaction->id,
                'payment_method' => null,
                'bank_id' => null,
                'debit' => $request->amounts[$key],
                'amount' => $request->amounts[$key],
                'note' => $request->notes[$key],
                'user_id' => Auth::id(),
                'status' => 1,
            ]);

            $voucher_count2 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            if ($request->payment_method == 1) {
                $payment_account = Account::find(3);
            } elseif ($request->payment_method == 2) {
                $payment_account = Account::find(4);
            } else {
                $payment_account = Account::find(5);
            }

            $credit_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($voucher_count2 + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => in_array($payment_account->account_class_id, [1, 4]) ? 1 : 2,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Debit transaction for transaction no. " . $transaction->transaction_no,
                'account_class_id' => $payment_account->account_class_id,
                'account_head_id' => $payment_account->account_head_id,
                'account_id' => $payment_account->id,
                'transaction_id' => $transaction->id,
                'payment_method' => $request->payment_method ?? null,
                'bank_id' => $request->bank_id ?? null,
                'credit' => $request->amounts[$key],
                'amount' => $request->amounts[$key],
                'note' => $request->notes[$key],
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }

        return redirect()->route('debit_transactions')->with('message', 'Debit transaction add successfully.');
    }

    public function debitTransactionDetails(Transaction $transaction)
    {
        return view('accounts.debit.details', compact('transaction'));
    }

    public function debitTransactionDatatable()
    {
        $query = Transaction::with('companyBranch')->where('client_id', Auth::user()->client_id)->where('type', 1);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('branch_name', function (Transaction $transaction) {
                return $transaction->companyBranch->name ?? '';
            })
            ->addColumn('date', function (Transaction $transaction) {
                return $transaction->date->format('d-m-Y');
            })
            ->addColumn('action', function (Transaction $transaction) {
                $btn = ' <a href="' . route('debit_transaction_details', ['transaction' => $transaction->id]) . '" class="btn btn-primary btn-sm"> Details </a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    /******************
     *  Credit Transaction
     */
    public function creditTransactions()
    {
        return view('accounts.credit.all');
    }

    public function employeeCreditTransactionAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->where('transaction_status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 2)->withTrashed()->count();
        $transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('accounts.credit.employee_credit', compact('accounts', 'branches', 'banks', 'transaction_no'));
    }

    public function supplierCreditTransactionAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->where('transaction_status', 1)->get();
        $suppliers = Supplier::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 2)->withTrashed()->count();
        $transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('accounts.credit.supplier_credit', compact('accounts', 'suppliers', 'banks', 'branches', 'transaction_no'));
    }

    public function creditTransactionAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->where('transaction_status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 2)->withTrashed()->count();
        $transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('accounts.credit.add', compact('accounts', 'banks', 'branches', 'transaction_no'));
    }

    public function creditTransactionStore(Request $request)
    {
        $request->validate([
            'company_branch_id' => 'required',
            'type' => 'required',
            'date' => 'required|date',
            'payment_method' => 'required',
            'bank_id' => 'required_if:payment_method,==,2',
            'remark' => 'nullable',
            'account_ids' => 'required',
            'account_ids.*' => 'required',
            'employee' => 'required_if:type,==,2',
            'supplier' => 'required_if:type,==,3',
            'amounts.*' => 'required|numeric',
            'notes.*' => 'nullable'
        ]);

        // Transaction
        $branch = CompanyBranch::find($request->company_branch_id);
        $count = Transaction::where('client_id', Auth::user()->client_id)->where('type', 2)->withTrashed()->count();
        $transaction = new Transaction();
        $transaction->client_id = Auth::user()->client_id;
        $transaction->company_branch_id = $branch->id;
        $transaction->transaction_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $transaction->date = $request->date;
        $transaction->type = 2;
        $transaction->payment_method = $request->payment_method;
        $transaction->employee_id = $request->employee ?? null;
        $transaction->supplier_id = $request->supplier ?? null;
        $transaction->remark = $request->remark;
        $transaction->amount = array_sum($request->amounts ?? []);
        $transaction->user_id = Auth::id();
        $transaction->save();

        // Transaction Log
        foreach ($request->account_ids ?? [] as $key => $account_id) {
            $account = Account::find($account_id);
            $voucher_count1 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            $credit_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($voucher_count1 + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => 6,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Credit transaction for transaction no. " . $transaction->transaction_no,
                'account_class_id' => $account->account_class_id,
                'account_head_id' => $account->account_head_id,
                'account_id' => $account->id,
                'employee_id' => $request->employee ?? null,
                'supplier_id' => $request->supplier ?? null,
                'transaction_id' => $transaction->id,
                'payment_method' => null,
                'bank_id' => null,
                'credit' => $request->amounts[$key],
                'amount' => $request->amounts[$key],
                'note' => $request->notes[$key],
                'user_id' => Auth::id(),
                'status' => 1,
            ]);

            $voucher_count2 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            if ($request->payment_method == 1) {
                $payment_account = Account::find(3);
            } elseif ($request->payment_method == 2) {
                $payment_account = Account::find(4);
            } else {
                $payment_account = Account::find(5);
            }

            $debit_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($voucher_count2 + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => in_array($payment_account->account_class_id, [1, 4]) ? 1 : 2,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Credit transaction for transaction no. " . $transaction->transaction_no,
                'account_class_id' => $payment_account->account_class_id,
                'account_head_id' => $payment_account->account_head_id,
                'account_id' => $payment_account->id,
                'transaction_id' => $transaction->id,
                'payment_method' => $request->payment_method ?? null,
                'bank_id' => $request->bank_id ?? null,
                'debit' => $request->amounts[$key],
                'amount' => $request->amounts[$key],
                'note' => $request->notes[$key],
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }

        return redirect()->route('credit_transactions')->with('message', 'Credit transaction add successfully.');
    }

    public function creditTransactionDetails(Transaction $transaction)
    {
        return view('accounts.credit.details', compact('transaction'));
    }

    public function creditTransactionDatatable()
    {
        $query = Transaction::where('client_id', Auth::user()->client_id)->where('type', 2);
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('date', function (Transaction $transaction) {
                return $transaction->date->format('d-m-Y');
            })
            ->addColumn('action', function (Transaction $transaction) {
                $btn = ' <a href="' . route('credit_transaction_details', ['transaction' => $transaction->id]) . '" class="btn btn-primary btn-sm"> Details </a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
