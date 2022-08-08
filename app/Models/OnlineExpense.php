<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineExpense extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['date', 'created_at'];

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }
}
