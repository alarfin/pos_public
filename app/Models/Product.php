<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
    public function productUnit()
    {
        return $this->belongsTo(ProductUnit::class);
    }
    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }
    public function productSize()
    {
        return $this->belongsTo(ProductSize::class);
    }

    public function stockReport($data = null)
    {
        $prev_in = InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->whereDate('date', '<', $data['start_date'])->where('type', 1);
        $prev_out = InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->whereDate('date', '<', $data['start_date'])->where('type', 2);
        $in = InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->whereBetween('date', [$data['start_date'], $data['end_date']])->where('type', 1);
        $out = InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->whereBetween('date', [$data['start_date'], $data['end_date']])->where('type', 2);


        if (isset($data['company_branch_id'])) {
            $prev_in->where('company_branch_id', $data['company_branch_id']);
            $prev_out->where('company_branch_id', $data['company_branch_id']);
            $in->where('company_branch_id', $data['company_branch_id']);
            $out->where('company_branch_id', $data['company_branch_id']);
        }

        return [
            'prev_in' => $prev_in->sum('quantity'),
            'prev_out' => $prev_out->sum('quantity'),
            'prev_in_buy_price' => $prev_in->sum('buy_total'),
            'prev_out_buy_price' => $prev_out->sum('buy_total'),
            'in' => $in->sum('quantity'),
            'out' => $out->sum('quantity'),
            'in_buy_price' => $in->sum('buy_total'),
            'out_buy_price' => $out->sum('buy_total'),
        ];
    }

    public function inQuantity()
    {
        return InventoryLog::where('client_id', Auth::user()->client_id)->where('product', $this->id)->where('type', 1)->sum('quantity');
    }

    public function inAmount()
    {
        return InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 1)->sum('buy_total');
    }

    public function outQuantity()
    {
        return InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 2)->sum('quantity');
    }

    public function outAmount()
    {
        return InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 2)->sum('buy_total');
    }

    public function stockQuantity()
    {
        return InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 1)->sum('quantity') - InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 2)->sum('quantity');
    }

    public function branchStockQuantity($branch_id = null)
    {
        return InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 1)->where('company_branch_id', $branch_id)->sum('quantity') - InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 2)->where('company_branch_id', $branch_id)->sum('quantity');
    }

    public function stockAmount()
    {
        return InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 1)->sum('total') - InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $this->id)->where('type', 2)->sum('total');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
