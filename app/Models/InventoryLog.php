<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['date'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->with('productCategory', 'productUnit');
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

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }
    public function saleOrder()
    {
        return $this->belongsTo(SaleOrder::class);
    }
    public function inQuantity()
    {
        $inventory_log = InventoryLog::find($this->id);
        return InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 1)->sum('quantity');
    }
    public function inAmount()
    {
        $inventory_log = InventoryLog::find($this->id);
        return InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 1)->sum('total');
    }
    public function outQuantity()
    {
        $inventory_log = InventoryLog::find($this->id);
        return InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 2)->sum('quantity');
    }
    public function outAmount()
    {
        $inventory_log = InventoryLog::find($this->id);
        return InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 2)->sum('total');
    }
    public function outBuyAmount()
    {
        $inventory_log = InventoryLog::find($this->id);
        return InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 2)->sum('buy_total');
    }
    public function stockQuantity()
    {
        $inventory_log = InventoryLog::find($this->id);
        $in_quantity = InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 1)->sum('quantity');
        $out_quantity = InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 2)->sum('quantity');
        return $in_quantity - $out_quantity;
    }
    public function stockAmount()
    {
        $inventory_log = InventoryLog::find($this->id);
        $in_amount = InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 1)->sum('total');
        $out_amount = InventoryLog::where('product_id', $inventory_log->product_id)->where('company_branch_id', $inventory_log->company_branch_id)->where('type', 2)->sum('buy_total');
        return $in_amount - $out_amount;
    }
}
