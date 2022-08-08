<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductTransfer extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['date', 'created_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function sourceCompanyBranch()
    {
        return $this->belongsTo(CompanyBranch::class, 'source_branch_id');
    }

    public function targetCompanyBranch()
    {
        return $this->belongsTo(CompanyBranch::class, 'target_branch_id');
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class);
    }
}
