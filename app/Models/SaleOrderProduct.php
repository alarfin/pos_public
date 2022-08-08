<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleOrderProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['date', 'created_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }

    public function saleOrder()
    {
        return $this->belongsTo(SaleOrder::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
