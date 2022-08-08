<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CompanyBranch;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AccountAdjustmentController extends Controller
{
    public function accountAdjustments()
    {
        return view('accounts.adjustment.all');
    }

    public function accountAdjustmentAdd()
    {
        $accounts = Account::where('client_id', Auth::user()->client_id)
            ->where('transaction_status', 1)->where('status', 1)
            ->orWhere('default_status', 1)->whereNotIn('id', [1, 2, 4, 7])->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('accounts.adjustment.add', compact('accounts', 'branches'));
    }

    public function accountAdjustmentStore(Request $request)
    {
        $request->validate([
            'company_branch_id' => 'required',
            'date' => 'required|date',
            'account_ids' => 'required',
            'account_ids.*' => 'required',
            'types.*' => 'required|numeric',
            'amounts.*' => 'required|numeric',
            'notes.*' => 'nullable'
        ]);


        $branch = CompanyBranch::find($request->company_branch_id);
        // Transaction Log
        foreach ($request->account_ids ?? [] as $key => $account_id) {
            $account = Account::find($account_id);
            $voucher_count = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            if ($request->types[$key] == 1) {
                $debit = $request->amounts[$key];
                $credit = 0;
                $particular = "Adjustment of DEBIT Transaction";
            } else {
                $debit = 0;
                $credit = $request->amounts[$key];
                $particular = "Adjustment of CREDIT Transaction";
            }
            $transaction_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($voucher_count + 1, 5, 0, STR_PAD_LEFT),
                'adjustment_status' => 1,
                'transaction_type' => 7,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => $particular,
                'account_class_id' => $account->account_class_id,
                'account_head_id' => $account->account_head_id,
                'account_id' => $account->id,
                'payment_method' => null,
                'bank_id' => null,
                'debit' => $debit,
                'credit' => $credit,
                'amount' => $request->amounts[$key],
                'note' => $request->notes[$key],
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }

        return redirect()->route('account_adjustments')->with('message', 'Adjustment transaction successfully done.');
    }

    public function accountAdjustmentDetails(TransactionLog $transaction_log)
    {
        return view('accounts.adjustment.details', compact('transaction_log'));
    }

    public function accountAdjustmentDatatable()
    {
        $query = TransactionLog::with('companyBranch')->where('client_id', Auth::user()->client_id)->where('adjustment_status', 1);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('branch_name', function (TransactionLog $transaction_log) {
                return $transaction_log->companyBranch->name ?? '';
            })
            ->addColumn('date', function (TransactionLog $transaction_log) {
                return $transaction_log->date->format('d-m-Y');
            })
            ->addColumn('action', function (TransactionLog $transaction_log) {
                $btn = ' <a href="' . route('account_adjustment_details', ['transaction_log' => $transaction_log->id]) . '" class="btn btn-primary btn-sm"> Details </a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
