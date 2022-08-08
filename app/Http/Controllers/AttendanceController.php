<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\CompanyBranch;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('hr.attendance.all');
    }

    public function add(Request $request)
    {
        $date = $request->date ?? date('Y-m-d');
        $selectedBranch = $request->company_branch_id ?? CompanyBranch::where('status', 1)->first()->id;
        $employees = Employee::with('designation')->where('client_id', Auth::user()->client_id)->where('company_branch_id', $selectedBranch)->where('status', 1)->get();
        $branches = CompanyBranch::where('status', 1)->get();
        return view('hr.attendance.add', compact('date', 'employees', 'branches', 'selectedBranch'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        // dd($request->all());
        $date = date('Y-m-d', strtotime($request->date));
        $employees = Employee::with('designation')->where('client_id', Auth::user()->client_id)->where('status', 1)->get();

        foreach ($employees as $employee) {
            $branch = CompanyBranch::find($employee->company_branch_id);
            // Present
            $present = 'present_' . $employee->id;
            $in_time = 'in_time_' . $employee->id;
            $out_time = 'out_time_' . $employee->id;
            $late = 'late_' . $employee->id;
            $note = 'note_' . $employee->id;

            $attendance = Attendance::where('employee_id', $employee->id)->whereDate('date', $date)->first();
            if (empty($attendance)) {
                $attendance = new Attendance();
                $attendance->client_id = Auth::user()->client_id;
                $attendance->user_id = Auth::id();
            }

            $attendance->employee_id = $employee->id;
            $attendance->company_branch_id = $employee->company_branch_id;
            $attendance->date = $date;
            $attendance->present = $request->$present ? 1 : 0;
            $attendance->in_time = $request->$in_time ? date('H:i:s', strtotime($request->$in_time)) : null;
            $attendance->out_time = $request->$out_time ? date('H:i:s', strtotime($request->$out_time)) : null;
            $attendance->late = $request->$late ? 1 : 0;
            $attendance->note = $request->$note ?? null;

            // Total time in second
            $time = 0;
            if ($request->$in_time && $request->$out_time) {
                $time = strtotime($date . ' ' . date('H:i:s', strtotime($request->$out_time))) - strtotime($date . ' ' . date('H:i:s', strtotime($request->$in_time)));
            }

            $attendance->total_time = $time;
            $attendance->save();
        }
        return redirect()->back()->with('message', 'Attendance added successfully done.');
    }

    public function attendanceDatatable()
    {
        $query = Attendance::with('client', 'employee', 'companyBranch')->where('client_id', Auth::user()->client_id);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('date', function (Attendance $attendance) {
                return date('d-m-Y', strtotime($attendance->date));
            })
            ->addColumn('branch_name', function (Attendance $attendance) {
                return $attendance->companyBranch->name ?? '';
            })
            ->addColumn('employee_name', function (Attendance $attendance) {
                return $attendance->employee->name ?? '';
            })
            ->addColumn('employee_mobile_no', function (Attendance $attendance) {
                return $attendance->employee->mobile_no ?? '';
            })
            ->addColumn('employee_designation', function (Attendance $attendance) {
                return $attendance->employee->designation->name ?? '';
            })
            ->addColumn('present', function (Attendance $attendance) {
                if ($attendance->present == 1) {
                    return '<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
                } elseif ($attendance->present == 2) {
                    return '<span class="text-blue"> Leave</span>';
                } else {
                    return '<span class="text-red"><i class="fa fa-times" aria-hidden="true"></i></span>';
                }
                return $attendance->employee->designation->name ?? '';
            })
            ->addColumn('late', function (Attendance $attendance) {
                if ($attendance->late == 1) {
                    return '<span class="text-success"><i class="fa fa-check" aria-hidden="true"></i></span>';
                } else {
                    // return '<span class="text-red"><i class="fa fa-times" aria-hidden="true"></i></span>';
                    return '-';
                }
                return $attendance->employee->designation->name ?? '';
            })
            ->editColumn('in_time', function (Attendance $attendance) {
                return $attendance->in_time ? date('h:i a', strtotime($attendance->in_time)) : null;
            })
            ->editColumn('out_time', function (Attendance $attendance) {
                return $attendance->out_time ? date('h:i a', strtotime($attendance->out_time)) : null;
            })
            ->addColumn('action', function (Attendance $attendance) {
                $btn = '';
                if (Auth::user()->can('employee_attendance_add')) {
                    $btn .= ' <a class="btn btn-primary btn-sm" href="' . route('attendance_add', ['date' => $attendance->date->format('Y-m-d')]) . '"> Edit </a> ';
                }

                return $btn;
            })
            ->rawColumns(['date', 'employee_name', 'employee_designation', 'present', 'in_time', 'out_time', 'late', 'action'])
            ->toJson();
    }
}
