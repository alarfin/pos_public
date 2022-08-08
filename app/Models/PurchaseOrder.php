<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PurchaseOrder extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dates = ['date'];

    public function products()
    {
        return $this->hasMany(PurchaseOrderProduct::class)->where('client_id', Auth::user()->client_id);
    }

    public function inventoryLogs()
    {
        return $this->hasMany(InventoryLog::class)->where('client_id', Auth::user()->client_id);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function companyBranch()
    {
        return $this->belongsTo(companyBranch::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function payments()
    {
        return $this->hasMany(TransactionLog::class)->where('client_id', Auth::user()->client_id);
    }
}
