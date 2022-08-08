<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class DesignationController extends Controller
{
    public function index()
    {
        return view('hr.designation.all');
    }

    public function add()
    {
        return view('hr.designation.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:50',
            'status' => 'required'
        ]);

        $designation = new Designation();
        $designation->client_id = Auth::user()->client_id;
        $designation->name = $request->name;
        $designation->short_name = $request->short_name;
        $designation->status = $request->status;
        $designation->user_id = Auth::id();
        $designation->save();

        return redirect()->route('designations')->with('message', 'Designation add successfully.');
    }

    public function edit(Designation $designation)
    {
        $this->clientCheck($designation);
        return view('hr.designation.edit', compact('designation'));
    }

    public function update(Request $request, Designation $designation)
    {
        $this->clientCheck($designation);
        $request->validate([
            'name' => 'required|string|max:255',
            'short_name' => 'required|string|max:50',
            'status' => 'required'
        ]);

        $designation->name = $request->name;
        $designation->short_name = $request->short_name;
        $designation->status = $request->status;
        $designation->save();

        return redirect()->route('designations')->with('message', 'Designation edit successfully.');
    }

    public function delete(Designation $designation)
    {
        $this->clientCheck($designation);
        $designation->delete();
        return redirect()->route('designations')->with('message', 'Designation delete successfully.');
    }

    public function designationDatatable()
    {
        $query = designation::where('client_id', Auth::user()->client_id)->orWhere('default_status', 1);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('status', function (Designation $designation) {
                if ($designation->status == 1) {
                    return '<span class="label label-success"> Active </status>';
                } else {
                    return '<span class="label label-danger">In Active</status>';
                }
            })
            ->addColumn('action', function (Designation $designation) {
                $btn = '';
                if ($designation->default_status == 0) {
                    if (Auth::user()->can('designation_edit')) {
                        $btn .= ' <a class="btn btn-info btn-sm" href="' . route('designation_edit', ['designation' => $designation->id]) . '">Edit</a> ';
                    }
                    if (Auth::user()->can('designation_delete')) {
                        $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('designation_delete', ['designation' => $designation->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                    }
                }

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
