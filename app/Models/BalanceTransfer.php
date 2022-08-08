<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BalanceTransfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['date','created_at'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function details(){
        return $this->hasMany(TransactionLog::class)->with('bank');
    }

    public function debitAccount(){
        return $this->belongsTo(Account::class, 'debit_account_id');
    }

    public function debitBank(){
        return $this->belongsTo(Bank::class, 'debit_bank_id');
    }

    public function creditAccount(){
        return $this->belongsTo(Account::class, 'credit_account_id');
    }

    public function creditBank(){
        return $this->belongsTo(Bank::class, 'credit_bank_id');
    }

}
