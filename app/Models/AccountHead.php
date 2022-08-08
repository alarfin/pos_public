<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AccountHead extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function accountClass()
    {
        return $this->belongsTo(AccountClass::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class)->where(function ($q) {
            $q->where('client_id', Auth::user()->client_id)->orWhere('default_status', 1);
        });
    }
    public function transactionAccounts()
    {
        return $this->hasMany(Account::class)->where(function ($q) {
            $q->where('client_id', Auth::user()->client_id)->where('transaction_status', 1)
                ->orWhere('default_status', 1)->where('transaction_status', 1);
        });
    }
}
