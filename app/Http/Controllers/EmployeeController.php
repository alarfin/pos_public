<?php

namespace App\Http\Controllers;

use App\Models\CompanyBranch;
use App\Models\Designation;
use App\Models\DesignationLog;
use App\Models\Employee;
use App\Models\SalaryLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('hr.employee.all');
    }

    public function add()
    {
        $designations = Designation::where('client_id', Auth::user()->client_id)->where('status', 1)
            ->orWhere('default_status', 1)->where('status', 1)->get();
        $branches = CompanyBranch::get();
        $count = Employee::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $id_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        return view('hr.employee.add', compact('designations', 'id_no', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'company_branch_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'mobile_no' => 'required|unique:users',
            'photo' => 'nullable|image',
            'signature' => 'nullable|image',
            'birth_date' => 'nullable|date',
            'join_date' => 'nullable|date',
            'password' => 'required|min:8',
            'status' => 'required'
        ]);

        /**
         * Save as a employee on user table
         */
        $branch = CompanyBranch::find($request->company_branch_id);

        $user =  new User();
        $user->client_id =  Auth::user()->client_id;
        $user->name =  $request->name;
        $user->company_branch_id =  $branch->id;
        $user->email  =  $request->email;
        $user->mobile_no  =  $request->mobile_no;
        $user->role_id  =  3;
        $user->password  =  Hash::make($request->password);
        $user->status = 1;
        $user->user_id = Auth::id();
        $user->save();

        /*Take the last id number of this company's employee*/
        $count = Employee::where('client_id', Auth::user()->client_id)->withTrashed()->count();

        /**
         * Save employee details
         */
        $employee = new Employee();
        $employee->client_id = Auth::user()->client_id;
        $employee->company_branch_id =  $branch->id;
        $employee->id_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->designation_id = $request->designation_id;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->salary = $request->salary;
        $employee->birth_date = $request->birth_date;
        $employee->permanent_address = $request->permanent_address;
        $employee->present_address = $request->present_address;
        $employee->join_date = $request->join_date;
        $employee->nid_no = $request->nid_no;
        $employee->mobile_no = $request->mobile_no;
        $employee->own_id = $user->id;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->religion = $request->religion;
        $employee->status = $request->status;
        $employee->user_id = Auth::id();

        if ($request->hasFile('photo')) {
            $employee->photo = $request->photo->store('/public/employee/photo');
        }

        if ($request->hasFile('signature')) {
            $employee->signature = $request->signature->store('/public/employee/signature');
        }

        $employee->save();

        /*Log of designation */
        $designation_log = new DesignationLog();
        $designation_log->client_id = Auth::user()->client_id;
        $designation_log->employee_id = $employee->id;
        $designation_log->designation_id = $request->designation_id;
        $designation_log->date = date('Y-m-d');
        $designation_log->save();
        /*Salary logs */
        $salary_log = new SalaryLog();
        $salary_log->client_id = Auth::user()->client_id;
        $salary_log->employee_id = $employee->id;
        $salary_log->note = 'Joining';
        $salary_log->type = 3;
        $salary_log->date = date('Y-m-d');
        $salary_log->save();
        return redirect()->route('employees')->with('message', 'Employee add successfully.');
    }

    public function edit(Employee $employee)
    {
        $this->clientCheck($employee);
        $designations = Designation::where('client_id', Auth::user()->client_id)->where('status', 1)
            ->orWhere('default_status', 1)->where('status', 1)->get();
        $branches = CompanyBranch::get();
        return view('hr.employee.edit', compact('employee', 'designations', 'branches'));
    }

    public function details(Employee $employee)
    {
        $this->clientCheck($employee);
        return view('hr.employee.details', compact('employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $this->clientCheck($employee);
        $request->validate([
            'company_branch_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $employee->own_id,
            'mobile_no' => 'required|unique:users,mobile_no,' . $employee->own_id,
            'birth_date' => 'nullable|date',
            'join_date' => 'nullable|date',
            'photo' => 'nullable|image',
            'signature' => 'nullable|image',
            'password' => 'nullable|min:8',
            'status' => 'required',
            Rule::unique('users')->ignore($employee->own_id),
        ]);

        /**
         * Save as a employee on user table
         */
        $branch = CompanyBranch::find($request->company_branch_id);

        $user =  User::find($employee->own_id);
        $user->name =  $request->name;
        $user->company_branch_id =  $branch->id;
        $user->email  =  $request->email;
        $user->mobile_no  =  $request->mobile_no;
        if ($request->password) {
            $user->password  =  Hash::make($request->password);
        }
        $user->save();

        /**
         * Save employee details
         */


        $employee->name = $request->name;
        $employee->company_branch_id =  $branch->id;
        $employee->email = $request->email;
        $employee->designation_id = $request->designation_id;
        $employee->father_name = $request->father_name;
        $employee->mother_name = $request->mother_name;
        $employee->salary = $request->salary;
        $employee->birth_date = $request->birth_date;
        $employee->permanent_address = $request->permanent_address;
        $employee->present_address = $request->present_address;
        $employee->join_date = $request->join_date;
        $employee->nid_no = $request->nid_no;
        $employee->mobile_no = $request->mobile_no;
        $employee->gender = $request->gender;
        $employee->marital_status = $request->marital_status;
        $employee->religion = $request->religion;
        $employee->status = $request->status;

        if ($request->hasFile('photo')) {
            if ($employee->photo) {
                Storage::delete($employee->photo);
            }
            $employee->photo = $request->photo->store('/public/employee/photo');
        }

        if ($request->hasFile('signature')) {
            if ($employee->signature) {
                Storage::delete($employee->signature);
            }
            $employee->signature = $request->signature->store('/public/employee/signature');
        }
        $employee->save();

        return redirect()->route('employees')->with('message', 'Employee edit successfully.');
    }

    public function delete(Employee $employee)
    {
        $this->clientCheck($employee);
        $employee->delete();
        return redirect()->route('employees')->with('message', 'Employee delete successfully.');
    }

    public function employeeDatatable()
    {
        $query = Employee::with('client', 'designation', 'companyBranch')->where('client_id', Auth::user()->client_id);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('designation', function (Employee $employee) {
                return $employee->designation->name ?? '';
            })
            ->editColumn('join_date', function (Employee $employee) {
                return $employee->join_date ? $employee->join_date->format('d-m-Y') : '';
            })
            ->editColumn('photo', function (Employee $employee) {
                if ($employee->photo) {
                    return '<img src="' . url('storage/app/' . $employee->photo) . '" width="40" height="40" />';
                } else {
                    return '<img src="' . url('public/img/no_image.png') . '" width="40" height="40" />';
                }
            })
            ->editColumn('status', function (Employee $employee) {
                if ($employee->status == 1) {
                    return '<span class="label label-success"> Active </status>';
                } else {
                    return '<span class="label label-danger">In Active</status>';
                }
            })
            ->addColumn('action', function (Employee $employee) {
                $btn = '';
                $btn .= ' <a class="btn btn-info btn-sm" href="' . route('employee_details', ['employee' => $employee->id]) . '">Details</a> ';
                if (Auth::user()->can('employee_edit')) {
                    $btn .= ' <a class="btn btn-primary btn-sm" href="' . route('employee_edit', ['employee' => $employee->id]) . '">Edit</a> ';
                }
                if (Auth::user()->can('employee_delete')) {
                    $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('employee_delete', ['employee' => $employee->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                }
                return $btn;
            })
            ->rawColumns(['photo', 'action', 'status'])
            ->toJson();
    }
}
