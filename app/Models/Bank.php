<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Bank extends Model
{
    protected $guarded = [];

    public function getBalanceAttribute()
    {
        $debit = TransactionLog::where('bank_id', $this->id)->where('status', 1)->sum('debit');
        $credit = TransactionLog::where('bank_id', $this->id)->sum('credit');
        return ($credit - $debit);
    }

    public function creditDetails($data = null)
    {

        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('bank_id', $this->id)->where('status', 1);
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
        return $credit;
    }
    public function debitDetails($data = null)
    {

        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('bank_id', $this->id)->where('status', 1);
        if (isset($data['company_branch_id'])) {
            $query->where('company_branch_id', $data['company_branch_id']);
        }
        if (isset($data['date'])) {
            $query->where('date', $data['date']);
        }
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $query->whereBetween('date', [$data['start_date'], $data['end_date']]);
        }
        $debit = $query->sum('debit');
        return $debit;
    }
    public function balanceDetails($data = null)
    {

        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('bank_id', $this->id)->where('status', 1);
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
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
