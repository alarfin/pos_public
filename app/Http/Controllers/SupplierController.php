<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index()
    {
        return view('supplier.all');
    }

    public function add()
    {
        return view('supplier.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'mobile_no' => 'required',
            'email' => 'nullable|email|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required'
        ]);

        $supplier = new Supplier();
        $supplier->client_id = Auth::user()->client_id;
        $supplier->name = $request->name;
        $supplier->company_name = $request->company_name;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->status = $request->status;
        $supplier->user_id = Auth::id();
        $supplier->save();

        return redirect()->route('supplier')->with('message', 'Supplier add successfully.');
    }

    public function edit(Supplier $supplier)
    {
        $this->clientCheck($supplier);
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Supplier $supplier, Request $request)
    {
        $this->clientCheck($supplier);
        $request->validate([
            'name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'mobile_no' => 'required',
            'email' => 'nullable|email|string|max:255',
            'address' => 'required|string|max:255',
            'status' => 'required',
        ]);

        $supplier->name = $request->name;
        $supplier->company_name = $request->company_name;
        $supplier->mobile_no = $request->mobile_no;
        $supplier->email = $request->email;
        $supplier->address = $request->address;
        $supplier->status = $request->status;
        $supplier->save();

        return redirect()->route('supplier')->with('message', 'Supplier edit successfully.');
    }

    public function delete(Supplier $supplier)
    {
        $this->clientCheck($supplier);
        $supplier->delete();
        return redirect()->route('supplier')->with('message', 'Supplier delete successfully.');
    }

    public function supplierDatatable()
    {
        $query = Supplier::where('client_id', Auth::user()->client_id);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('balance', function (Supplier $supplier) {
                return number_format($supplier->balance, 2);
            })
            ->editColumn('status', function (Supplier $supplier) {
                if ($supplier->status == 1) {
                    return '<span class="label label-success"> Active </status>';
                } else {
                    return '<span class="label label-danger">In Active</status>';
                }
            })
            ->addColumn('action', function (Supplier $supplier) {
                $btn = '';
                if (Auth::user()->can('supplier_edit')) {
                    $btn .= ' <a class="btn btn-info btn-sm" href="' . route('supplier_edit', ['supplier' => $supplier->id]) . '">Edit</a> ';
                }
                if (Auth::user()->can('supplier_delete')) {
                    $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('supplier_delete', ['supplier' => $supplier->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                }

                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
