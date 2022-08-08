<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryProcess extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = ['date','created_at'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function companyBranch(){
        return $this->belongsTo(CompanyBranch::class);
    }

    public function salaryDetails(){
        return $this->hasMany(SalaryProcessDetails::class);
    }
}
