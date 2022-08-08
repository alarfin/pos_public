<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    protected $dates = ['date'];

    public function salesOrder() {
        return $this->belongsTo(SalesOrder::class);
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function account() {
        return $this->belongsTo(BankAccount::class, 'bank_account_id', 'id');
    }
}
