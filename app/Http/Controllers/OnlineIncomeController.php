<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\OnlineIncome;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OnlineIncomeController extends Controller
{
    public function index()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)->where('account_class_id', 3)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('online_income.all', compact('accounts', 'branches'));
    }
    public function add()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)->where('account_class_id', 3)->where('status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('online_income.add', compact('accounts', 'banks', 'branches'));
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
        $count = OnlineIncome::where('client_id', Auth::user()->client_id)->withTrashed()->count();

        $data['serial_no'] = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $data['client_id'] = Auth::user()->client_id;
        $data['account_head_id'] = $account->account_head_id;
        $data['user_id'] = Auth::id();
        $online_income = OnlineIncome::create($data);

        // Online Information Credit
        $voucher_count = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        TransactionLog::create([
            'client_id' => Auth::user()->client_id,
            'company_branch_id' => $request->company_branch_id,
            'voucher_no' => str_pad($voucher_count + 1, 5, 0, STR_PAD_LEFT),
            'transaction_type' => 10,
            'date' => date('Y-m-d', strtotime($request->date)),
            'particular' => "Online income for serial no. " . $online_income->serial_no,
            'account_class_id' => $account->account_class_id,
            'account_head_id' => $account->account_head_id,
            'account_id' => $account->id,
            'customer_id' => null,
            'online_income_id' => $online_income->id,
            'payment_method' => null,
            'bank_id' => null,
            'credit' => $online_income->amount,
            'amount' => $online_income->amount,
            'note' => "Online Income",
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
            'particular' => "Online income for serial no. " . $online_income->serial_no,
            'account_class_id' => $payment_account->account_class_id,
            'account_head_id' => $payment_account->account_head_id,
            'account_id' => $payment_account->id,
            'customer_id' => null,
            'online_income_id' => $online_income->id,
            'payment_method' => $request->payment_method ?? null,
            'bank_id' => $request->bank_id ?? null,
            'credit' => $request->amount,
            'amount' => $request->amount,
            'note' => "Online Income",
            'user_id' => Auth::id(),
            'status' => 1,
        ]);

        return redirect()->route('online_incomes')->with('message', 'Online income added successfully.');
    }

    public function details(OnlineIncome $online_income)
    {
        $this->clientCheck($online_income);
        return view('online_income.details', compact('online_income'));
    }

    public function edit(OnlineIncome $online_income)
    {
        $this->clientCheck($online_income);
        $accounts = Account::where('client_id', Auth::user()->client_id)->where('account_class_id', 3)->where('status', 1)->get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();

        return view('online_income.edit', compact('online_income', 'accounts', 'banks', 'branches'));
    }

    public function update(Request $request, OnlineIncome $online_income)
    {
        dd('Remove Code for demo');

        return redirect()->route('online_incomes')->with('message', 'Online information updated successfully.');
    }

    public function delete(OnlineIncome $online_income)
    {
        $this->clientCheck($online_income);
        TransactionLog::where('online_income_id', $online_income->id)->delete();
        $online_income->delete();
        return redirect()->route('online_incomes')->with('message', 'Online income deleted successfully.');
    }

    public function onlineIncomeDatatable(Request $request)
    {
        $query = OnlineIncome::with('companyBranch', 'account')->where('client_id', Auth::user()->client_id)->orderBy('id', 'desc');
        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }

        if ($request->account_id) {
            $query->where('account_id', $request->account_id);
        }

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('company_branch_name', function (OnlineIncome $online_income) {
                return $online_income->companyBranch->name ?? '';
            })
            ->editColumn('date', function (OnlineIncome $online_income) {
                return $online_income->date->format('d-m-Y');
            })
            ->editColumn('status', function (OnlineIncome $online_income) {
                if ($online_income->status == 1) {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function (OnlineIncome $online_income) {
                $btn = '';
                $btn .= ' <a href="' . route('online_income_details', ['online_income' => $online_income->id]) . '" class="btn btn-info btn-sm">View</a> ';
                if (Auth::user()->can('online_income_edit')) {
                    $btn .= ' <a href="' . route('online_income_edit', ['online_income' => $online_income->id]) . '" class="btn btn-primary btn-sm"> Edit </a> ';
                }

                if (Auth::user()->can('online_income_delete')) {
                    $btn .= ' <a href="' . route('online_income_delete', ['online_income' => $online_income->id]) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete ?\');">Delete</a> ';
                }


                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
