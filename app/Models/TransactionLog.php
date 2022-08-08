<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionLog extends Model
{
    use SoftDeletes, HasFactory;
    protected $guarded = [];
    protected $dates = ['date', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function companyBranch()
    {
        return $this->belongsTo(CompanyBranch::class);
    }

    public function accountHead()
    {
        return $this->belongsTo(AccountHead::class);
    }

    public function accountClass()
    {
        return $this->belongsTo(AccountClass::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
