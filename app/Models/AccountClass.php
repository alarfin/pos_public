<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class AccountClass extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function accountHeads()
    {
        return $this->hasMany(AccountHead::class)->where(function ($q) {
            $q->where('client_id', Auth::user()->client_id)->orWhere('default_status', 1);
        });
    }
}
