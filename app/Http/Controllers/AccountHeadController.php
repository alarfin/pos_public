<?php

namespace App\Http\Controllers;

use App\Models\AccountClass;
use App\Models\AccountHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AccountHeadController extends Controller
{
    public function index()
    {
        return view('accounts.account_head.all');
    }

    public function add()
    {
        $account_classes = AccountClass::where('status', 1)->get();
        return view('accounts.account_head.add', compact('account_classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_class_id' => 'required',
            'status' => 'required'
        ]);
        $data = $request->all();
        AccountHead::create($data);

        return redirect()->route('account_heads')->with('message', 'Account head added successfully.');
    }

    public function edit(AccountHead $account_head)
    {
        $this->clientCheck($account_head);
        $account_classes = AccountClass::where('status', 1)->get();
        return view('accounts.account_head.edit', compact('account_head', 'account_classes'));
    }

    public function update(Request $request, AccountHead $account_head)
    {
        $this->clientCheck($account_head);
        $request->validate([
            'name' => 'required|string|max:255',
            'account_class_id' => 'required',
            'status' => 'required'
        ]);

        $data = $request->all();
        $account_head->update($data);

        return redirect()->route('account_heads')->with('message', 'Account head edit successfully.');
    }
    public function delete(AccountHead $account_head)
    {
        $this->clientCheck($account_head);
        $account_head->delete();
        return redirect()->route('account_heads')->with('message', 'Account head deleted successfully.');
    }

    public function accountHeadsDatatable()
    {
        $query = AccountHead::with('accountClass')->where('client_id', Auth::user()->client_id)->orWhere('default_status', 1);
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('account_class', function (AccountHead $account_head) {
                return $account_head->accountClass->name ?? '';
            })
            ->editColumn('status', function (AccountHead $account_head) {
                if ($account_head->status == 1) {
                    return '<span class="label label-success">Active</span>';
                } else {
                    return '<span class="label label-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function (AccountHead $account_head) {
                $btn = '';
                if (Auth::user()->can('account_head_edit') && $account_head->default_status == 0) {
                    $btn .= ' <a class="btn btn-info btn-sm" href="' . route('account_head_edit', ['account_head' => $account_head->id]) . '"> Edit </a> ';
                    // $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('account_head_delete', ['account_head' => $account_head->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                }
                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
