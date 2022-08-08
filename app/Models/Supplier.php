<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Supplier extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getBalanceAttribute()
    {
        $sale_credit = TransactionLog::where('client_id', Auth::user()->client_id)->where('supplier_id', $this->id)->whereIn('account_id', [1])->sum('credit');
        $sale_paid = TransactionLog::where('client_id', Auth::user()->client_id)->where('supplier_id', $this->id)->whereIn('account_id', [3, 4])->sum('credit');
        return ($sale_credit - $sale_paid);
    }

    public function getDebitAttribute()
    {
        return TransactionLog::where('client_id', Auth::user()->client_id)->where('supplier_id', $this->id)->whereIn('account_id', [3, 4])->sum('debit');
    }

    public function getCreditAttribute()
    {
        return TransactionLog::where('client_id', Auth::user()->client_id)->where('supplier_id', $this->id)->whereIn('account_id', [1])->sum('credit');
    }

    public function credit($data = null)
    {
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('supplier_id', $this->id)->whereIn('account_id', [1])->where('status', 1);
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

    public function debit($data = null)
    {
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('supplier_id', $this->id)->whereIn('account_id', [3, 4])->where('status', 1);
        if (isset($data['company_branch_id'])) {
            $query->where('company_branch_id', $data['company_branch_id']);
        }
        if (isset($data['date'])) {
            $query->where('date', $data['date']);
        }
        if (isset($data['start_date']) && isset($data['end_date'])) {
            $query->whereBetween('date', [$data['start_date'], $data['end_date']]);
        }
        $debit = $query->sum('credit');
        return $debit;
    }
}
