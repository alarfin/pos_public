<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    protected $dates = ['date', 'next_payment'];

    public function products() {
        return $this->belongsToMany(PurchaseProduct::class)
            ->withPivot('id', 'name', 'serial', 'warranty', 'quantity', 'unit_price', 'total');
    }

    public function payments() {
        return $this->hasMany(SalePayment::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function services() {
        return $this->hasMany(Service::class);
    }
}
