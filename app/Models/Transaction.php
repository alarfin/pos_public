<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = [];
    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function debitTransactionLog(){
        return $this->hasMany(TransactionLog::class)->where('debit','>',0);
    }

    public function creditTransactionLog(){
        return $this->hasMany(TransactionLog::class)->where('credit','>',0);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }

    public function companyBranch() {
        return $this->belongsTo(CompanyBranch::class);
    }

    public function accountHead() {
        return $this->belongsTo(AccountHead::class);
    }

    public function accountClass() {
        return $this->belongsTo(AccountClass::class);
    }

    public function account() {
        return $this->belongsTo(Account::class);
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

}
