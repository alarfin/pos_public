<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Employee extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [];
    protected $dates = ['birth_date', 'join_date', 'created_at'];

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function companyBranch(){
        return $this->belongsTo(CompanyBranch::class);
    }

    public function designation(){
        return $this->belongsTo(Designation::class);
    }

    public function attendance($date){
        return Attendance::where('employee_id', $this->id)->whereDate('date', $date)->first();
    }

    public function employeeAccount($data=null){
        $query = TransactionLog::where('client_id', Auth::user()->client_id)->where('account_id', $data['account_id'])
            ->where('employee_id', $this->id)->whereBetween('date', [$data['start_date'],$data['end_date']]);
        return $query->sum('credit')-$query->sum('debit');
    }

}
