<?php

namespace App\Http\Controllers;

use App\Models\AccountClass;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AccountController extends Controller
{
    public function index()
    {
        return view('accounts.account.all');
    }

    public function add()
    {
        $account_classes = AccountClass::where('status', 1)->get();
        return view('accounts.account.add', compact('account_classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_head_id' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        Account::create($data);

        return redirect()->route('accounts')->with('message', 'Account added successfully.');
    }

    public function edit(Account $account)
    {
        $this->clientCheck($account);
        $account_classes = AccountClass::where('status', 1)->get();
        return view('accounts.account.edit', compact('account', 'account_classes'));
    }

    public function update(Request $request, Account $account)
    {
        dd('Remove Code for demo');

        return redirect()->route('accounts')->with('message', 'Account edit successfully.');
    }
    public function delete(Account $account)
    {
        $account->delete();
        return redirect()->route('accounts')->with('message', 'Account deleted successfully.');
    }

    public function AccountsDatatable()
    {
        $query = Account::with('accountClass', 'accountHead')->where('client_id', Auth::user()->client_id)->orWhere('default_status', 1);
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('account_class', function (Account $account) {
                return $account->accountClass->name ?? '';
            })
            ->addColumn('account_head', function (Account $account) {
                return $account->accountHead->name ?? '';
            })
            ->editColumn('status', function (Account $account) {
                if ($account->status == 1) {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function (Account $account) {
                $btn = '';

                if (Auth::user()->can('account_edit') && $account->default_status == 0) {
                    $btn .= ' <a class="btn btn-info btn-sm" href="' . route('account_edit', ['account' => $account->id]) . '"> Edit </a> ';
                    // $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('account_delete', ['account' => $account->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                }
                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
