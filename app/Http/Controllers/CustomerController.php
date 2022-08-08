<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.all');
    }

    public function add()
    {
        return view('customer.add');
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|numeric|unique:customers',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'status' => 'required',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->user_id = Auth::id();
        $customer->save();

        return redirect()->route('customer')->with('message', 'Customer add successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customer.edit', compact('customer'));
    }

    public function editPost(Customer $customer, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_no' => 'required|numeric|unique:customers,mobile_no,' . $customer->id,
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:255',
            'status' => 'required',
        ]);

        $customer->name = $request->name;
        $customer->mobile_no = $request->mobile_no;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->status = $request->status;
        $customer->save();

        return redirect()->route('customer')->with('message', 'Customer edit successfully.');
    }

    public function delete(Customer $customer)
    {
        $this->clientCheck($customer);
        $customer->delete();
        return redirect()->route('customer')->with('message', 'Customer delete successfully.');
    }

    public function storeCustomer(Request $request)
    {
        $rules = [
            'mobile_no' => 'required|numeric|unique:customers',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $customer = Customer::create($data);
        return response()->json(['success' => true, 'message' => 'Customer has been added.']);
    }

    public function customerDatatable()
    {
        $query = Customer::where('client_id', Auth::user()->client_id);
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('status', function (Customer $customer) {
                if ($customer->status == 1) {
                    return '<span class="label label-success"> Active </span>';
                } else {
                    return '<span class="label label-danger"> In Active </span>';
                }
            })
            ->addColumn('balance', function (Customer $customer) {
                return number_format($customer->balance, 2);
            })
            ->addColumn('action', function (Customer $customer) {
                $btn = '';
                if (Auth::user()->can('customer_edit')) {
                    $btn .= ' <a class="btn btn-info btn-sm" href="' . route('customer_edit', ['customer' => $customer->id]) . '"> Edit </a> ';
                }

                $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('customer_delete', ['customer' => $customer->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                return $btn;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }
}
