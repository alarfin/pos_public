<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Attendance;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\Employee;
use App\Models\SalaryProcess;
use App\Models\SalaryProcessDetails;
use App\Models\TransactionLog;
use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SalaryProcessController extends Controller
{
    public function index()
    {
        return view('hr.salary_process.all');
    }

    public function add()
    {
        $years = Year::get();
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('hr.salary_process.add', compact('years', 'banks', 'branches'));
    }

    public function store(Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->route('salary_processes')->with('message', 'Salary process successfully done.');
    }

    public function delete(SalaryProcess $salary_process)
    {
        $this->clientCheck($salary_process);
        // Remove details data
        SalaryProcessDetails::where('salary_process_id', $salary_process->id)->delete();
        // Remove Transaction Log
        $transaction_logs = TransactionLog::where('salary_process_id', $salary_process->id)->get();
        foreach ($transaction_logs as $transaction_log) {
            $transaction_log->delete_user_id = Auth::id();
            $transaction_log->save();
            $transaction_log->delete();
        }
        // Remove salary process
        $salary_process->delete_user_id = Auth::id();
        $salary_process->save();
        $salary_process->delete();

        return redirect()->back()->with('message', 'Salary Process delete successfully done.');
    }

    public function salaryProcessDatatable()
    {
        $query = SalaryProcess::with('client', 'companyBranch')->where('client_id', Auth::user()->client_id);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('date', function (SalaryProcess $salary_process) {
                return $salary_process->date->format('d-m-Y');
            })
            ->addColumn('branch_name', function (SalaryProcess $salary_process) {
                return $salary_process->companyBranch->name ?? '';
            })
            ->editColumn('month', function (SalaryProcess $salary_process) {
                return date('F', strtotime('2022-' . $salary_process->month . '-01'));
            })
            ->editColumn('payment_method', function (SalaryProcess $salary_process) {
                if ($salary_process->payment_method == 1) {
                    return "Cash In Hand";
                } elseif ($salary_process->payment_method == 2) {
                    $bank = Bank::find($salary_process->bank_id);
                    return $bank->account_no . '-' . $bank->account_name;
                } else {
                    return '';
                }
            })
            ->editColumn('total', function (SalaryProcess $salary_process) {
                return number_format($salary_process->total, 2);
            })
            ->addColumn('action', function (SalaryProcess $salary_process) {
                $btn = '';
                $btn .= ' <a class="btn btn-primary btn-sm" href="' . route('report_salary_sheet', ['company_branch_id' => $salary_process->company_branch_id, 'year' => $salary_process->year, 'month' => $salary_process->month]) . '"> Details </a> ';
                if (Auth::user()->can('salary_process_delete')) {
                    $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('salary_process_delete', ['salary_process' => $salary_process->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                }

                return $btn;
            })
            ->rawColumns(['month', 'action', 'payment_method'])
            ->toJson();
    }
}
