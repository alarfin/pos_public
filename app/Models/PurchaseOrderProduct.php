<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrderProduct extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['return_at', 'date', 'created_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
