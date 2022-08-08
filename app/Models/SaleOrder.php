<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrder extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['date', 'created_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function products()
    {
        return $this->hasMany(SaleOrderProduct::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
