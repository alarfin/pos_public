<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
