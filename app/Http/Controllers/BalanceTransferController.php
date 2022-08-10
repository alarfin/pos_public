<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\BalanceTransfer;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BalanceTransferController extends Controller
{
    public function balanceTransfers()
    {
        return view('accounts.balance_transfer.all');
    }

    public function balanceTransferAdd()
    {
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $count = BalanceTransfer::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $transfer_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('accounts.balance_transfer.add', compact('banks', 'transfer_no', 'branches'));
    }

    public function balanceTransferStore(Request $request)
    {
        $request->validate([
            'company_branch_id' => 'required',
            'date' => 'required|date',
            'debit_payment_method' => 'required',
            'credit_payment_method' => 'required',
            'debit_bank_id' => 'required_if:debit_payment_method,==,2',
            'credit_bank_id' => 'required_if:credit_payment_method,==,2',
            'amount' => 'required|numeric',
            'note' => 'nullable'
        ]);

        // dd($request->all());
        $count = BalanceTransfer::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        if ($request->debit_payment_method == 1) {
            $debit_account = Account::find(3);
        } elseif ($request->debit_payment_method == 2) {
            $debit_account = Account::find(4);
        } else {
            $debit_account = Account::find(5);
        }

        if ($request->credit_payment_method == 1) {
            $credit_account = Account::find(3);
        } elseif ($request->credit_payment_method == 2) {
            $credit_account = Account::find(4);
        } else {
            $credit_account = Account::find(5);
        }

        $branch = CompanyBranch::find($request->company_branch_id);
        $balance_transfer = BalanceTransfer::create([
            'client_id' => Auth::user()->client_id,
            'company_branch_id' => $branch->id,
            'transfer_no' => str_pad($count + 1, 5, 0, STR_PAD_LEFT),
            'date' => date('Y-m-d', strtotime($request->date)),
            'debit_payment_method' => $request->debit_payment_method,
            'debit_account_id' => $debit_account->id,
            'debit_bank_id' => $request->debit_bank_id,
            'credit_payment_method' => $request->credit_payment_method,
            'credit_account_id' => $credit_account->id,
            'credit_bank_id' => $request->credit_bank_id,
            'amount' => $request->amount,
            'note' => $request->note,
            'user_id' => Auth::id(),
            'status' => 1,
        ]);

        if ($balance_transfer) {
            // Debit Transaction
            $debit_voucher = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            $debit_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($debit_voucher + 1, 5, 0, STR_PAD_LEFT),
                'balance_transfer_id' => $balance_transfer->id,
                'transaction_type' => 2,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Debit Balance Transfer from " . $credit_account->name,
                'account_class_id' => $debit_account->account_class_id,
                'account_head_id' => $debit_account->account_head_id,
                'account_id' => $debit_account->id,
                'payment_method' => $request->debit_payment_method,
                'bank_id' => $request->debit_bank_id,
                'debit' => $request->amount,
                'amount' => $request->amount,
                'note' => $request->note,
                'user_id' => Auth::id(),
                'status' => 1,
            ]);

            // Credit Transaction
            $credit_voucher = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            $credit_log = TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $branch->id,
                'voucher_no' => str_pad($credit_voucher + 1, 5, 0, STR_PAD_LEFT),
                'balance_transfer_id' => $balance_transfer->id,
                'transaction_type' => 1,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Credit Balance Transfer from " . $debit_account->name,
                'account_class_id' => $credit_account->account_class_id,
                'account_head_id' => $credit_account->account_head_id,
                'account_id' => $credit_account->id,
                'payment_method' => $request->credit_payment_method,
                'bank_id' => $request->credit_bank_id,
                'credit' => $request->amount,
                'amount' => $request->amount,
                'note' => $request->note,
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }

        return redirect()->route('balance_transfers')->with('message', 'Balance transfer successfully done.');
    }

    public function balanceTransferDetails(BalanceTransfer $balance_transfer)
    {
        dd('Remove Code for demo');
        return view('accounts.balance_transfer.details', compact('balance_transfer'));
    }

    public function balanceTransferDatatable()
    {
        $query = BalanceTransfer::with('debitAccount', 'creditAccount')->where('client_id', Auth::user()->client_id);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('debit_account', function (BalanceTransfer $balance_transfer) {
                if ($balance_transfer->debit_payment_method == 2) {
                    return $balance_transfer->debitAccount->name ?? '' . ' - ' . $balance_transfer->debitBank->name ?? '';
                } else {
                    return $balance_transfer->debitAccount->name ?? '';
                }
            })
            ->addColumn('credit_account', function (BalanceTransfer $balance_transfer) {
                if ($balance_transfer->credit_payment_method == 2) {
                    $data = $balance_transfer->creditAccount->name . ' - ' . $balance_transfer->creditBank->name;
                    return $data;
                } else {
                    return $balance_transfer->creditAccount->name ?? '';
                }
            })
            ->addColumn('date', function (BalanceTransfer $balance_transfer) {
                return $balance_transfer->date->format('d-m-Y');
            })
            ->addColumn('action', function (BalanceTransfer $balance_transfer) {
                $btn = ' <a href="' . route('balance_transfer_details', ['balance_transfer' => $balance_transfer->id]) . '" class="btn btn-primary btn-sm"> Details </a> ';
                return $btn;
            })
            ->rawColumns(['action', 'debit_account', 'credit_account'])
            ->toJson();
    }
}
