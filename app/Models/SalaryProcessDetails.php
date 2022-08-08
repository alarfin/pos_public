<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryProcessDetails extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function salaryProcess(){
        return $this->belongsTo(SalaryProcess::class);
    }

    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
