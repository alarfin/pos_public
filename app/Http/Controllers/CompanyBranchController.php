<?php

namespace App\Http\Controllers;

use App\Models\CompanyBranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class CompanyBranchController extends Controller
{
    public function index()
    {
        return view('administrator.company_branch.all');
    }

    public function add()
    {
        return view('administrator.company_branch.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|string|max:255',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'image' => 'nullable|image',
            'status' => 'required',
        ]);

        $company_branch = new CompanyBranch();
        if ($request->hasFile('image')) {
            $company_branch->image = $this->fileUpload($request->image, 'public/uploads/company_branch/', 800, 400);
        }
        $company_branch->client_id = Auth::user()->client_id;
        $company_branch->name = $request->name;
        $company_branch->mobile_no = $request->mobile_no;
        $company_branch->email = $request->email;
        $company_branch->address = $request->address;
        $company_branch->status = $request->status;
        $company_branch->user_id = Auth::id();
        $company_branch->save();

        return redirect()->route('company_branches')->with('message', 'Company branch add successfully.');
    }

    public function edit(CompanyBranch $company_branch)
    {
        $this->clientCheck($company_branch);
        return view('administrator.company_branch.edit', compact('company_branch'));
    }

    public function editPost(Request $request, CompanyBranch $company_branch)
    {
        dd('Remove Code for demo');

        return redirect()->route('company_branches')->with('message', 'Company branch edit successfully.');
    }

    public function delete(CompanyBranch $company_branch)
    {
        dd('Remove Code for demo');
        return redirect()->route('company_branches')->with('message', 'Company branch delete successfully.');
    }

    public function companyBranchDatatable()
    {
        $query = CompanyBranch::where('client_id', Auth::user()->client_id);
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('status', function (CompanyBranch $company_branch) {
                if ($company_branch->status == 1) {
                    return '<span class="label label-success"> Active </span>';
                } else {
                    return '<span class="label label-danger"> In Active </span>';
                }
            })
            ->addColumn('balance', function (CompanyBranch $company_branch) {
                return number_format($company_branch->balance, 2);
            })
            ->addColumn('action', function (CompanyBranch $company_branch) {
                $btn = '';
                if (Auth::user()->can('company_branch_edit')) {
                    $btn .= ' <a class="btn btn-info btn-sm" href="' . route('company_branch_edit', ['company_branch' => $company_branch->id]) . '"> Edit </a> ';
                }

                $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('company_branch_delete', ['company_branch' => $company_branch->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
