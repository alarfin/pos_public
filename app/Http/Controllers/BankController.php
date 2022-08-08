<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::where('client_id', Auth::user()->client_id)->get();
        return view('bank.all', compact('banks'));
    }

    public function add()
    {
        return view('bank.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_code' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $bank = new Bank();
        $bank->client_id = Auth::user()->client_id;
        $bank->name = $request->name;
        $bank->account_name = $request->account_name;
        $bank->account_no = $request->account_no;
        $bank->account_code = $request->account_code;
        $bank->branch = $request->branch;
        $bank->status = $request->status;
        $bank->user_id = Auth::id();
        $bank->save();

        return redirect()->route('bank')->with('message', 'Bank add successfully.');
    }

    public function edit(Bank $bank)
    {
        $this->clientCheck($bank);
        return view('bank.edit', compact('bank'));
    }

    public function editPost(Bank $bank, Request $request)
    {
        $this->clientCheck($bank);
        $request->validate([
            'name' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_code' => 'nullable|string|max:255',
            'status' => 'required'
        ]);

        $bank->name = $request->name;
        $bank->account_name = $request->account_name;
        $bank->account_no = $request->account_no;
        $bank->account_code = $request->account_code;
        $bank->branch = $request->branch;
        $bank->status = $request->status;
        $bank->save();

        return redirect()->route('bank')->with('message', 'Bank edit successfully.');
    }

    public function delete(Bank $bank)
    {
        $this->clientCheck($bank);
        $bank->delete();
        return redirect()->route('bank')->with('message', 'Bank deleted successfully done.');
    }
}
