<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Account extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function accountClass()
    {
        return $this->belongsTo(AccountClass::class);
    }
    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }


    public function debit($data = null)
    {
        $account = Account::find($this->id);
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('account_id', $account->id)->where('status', 1);
        if (isset($data['date'])) {
            $query->where('date', $data['date']);
        }
        if (isset($data['company_branch_id'])) {
            $query->where('company_branch_id', $data['company_branch_id']);
        }
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $query->whereBetween('date', [$data['start_date'], $data['end_date']]);
        }

        return $query->sum('debit');
    }
    public function credit($data = null)
    {
        $account = Account::find($this->id);
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('account_id', $account->id)->where('status', 1);
        if (isset($data['company_branch_id'])) {
            $query->where('company_branch_id', $data['company_branch_id']);
        }
        if (isset($data['date'])) {
            $query->where('date', $data['date']);
        }
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $query->whereBetween('date', [$data['start_date'], $data['end_date']]);
        }
        return $query->sum('credit');
    }

    public function balance($data = null)
    {
        $account = Account::find($this->id);
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('account_id', $account->id)->where('status', 1);
        if (isset($data['company_branch_id'])) {
            $query->where('company_branch_id', $data['company_branch_id']);
        }
        if (isset($data['date'])) {
            $query->where('date', $data['date']);
        }
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $query->whereBetween('date', [$data['start_date'], $data['end_date']]);
        }
        $credit = $query->sum('credit');
        $debit = $query->sum('debit');
        return ($credit - $debit);
        // if(in_array($account->account_class_id, [1,4])){
        //     return ($debit-$credit);
        // }else{
        //     return ($credit - $debit);
        // }

    }

    public function openingBalance($data = null)
    {
        $account = Account::find($this->id);
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('account_id', $account->id)->where('status', 1);
        if (isset($data['company_branch_id'])) {
            $query->where('company_branch_id', $data['company_branch_id']);
        }
        if (isset($data['date'])) {
            $query->where('date', '<', $data['date']);
        }
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $query->where('date', '<', $data['start_date']);
        }
        $credit = $query->sum('credit');
        $debit = $query->sum('debit');
        return ($credit - $debit);
    }
    public function closingBalance($data = null)
    {
        $account = Account::find($this->id);
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('account_id', $account->id)->where('status', 1);
        if (isset($data['company_branch_id'])) {
            $query->where('company_branch_id', $data['company_branch_id']);
        }
        if (isset($data['date'])) {
            $query->where('date', '<=', $data['date']);
        }
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $query->where('date', '<=', $data['start_date']);
        }
        $credit = $query->sum('credit');
        $debit = $query->sum('debit');
        return ($credit - $debit);
    }
}
