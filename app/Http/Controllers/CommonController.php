<?php

namespace App\Http\Controllers;

use App\Models\CompanyBranch;
use App\Models\Course;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\InventoryLog;
use App\Models\Month;
use App\Models\Product;
use App\Models\SalaryProcess;
use App\Models\SalesOrder;
use App\Models\Student;
use App\Models\Supplier;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CommonController extends Controller
{
    public function orderDetails(Request $request)
    {
        $order = SalesOrder::where('id', $request->orderId)->with('customer')->first()->toArray();
        return response()->json($order);
    }

    public function getsuppliers(Request $request)
    {
        $suppliers = [];
        if ($request->has('q')) {
            $search = $request->q;
            $suppliers = Supplier::where('client_id', Auth::user()->client_id)->select("id", "name", "mobile_no")
                ->where('name', 'LIKE', "%$search%")
                ->take(100)
                ->get();
        } else {
            $suppliers = Supplier::where('client_id', Auth::user()->client_id)->select("id", "name", "mobile_no")
                ->orderBy('id', 'asc')
                ->take(200)
                ->get();
        }
        // dd($suppliers);
        return response()->json($suppliers);
    }
    public function getCustomers(Request $request)
    {
        $customers = [];
        if ($request->has('q')) {
            $search = $request->q;
            $customers = Customer::where('client_id', Auth::user()->client_id)->select("id", "name", "mobile_no")
                ->where('name', 'LIKE', "%$search%")
                ->orWhere('mobile_no', 'LIKE', "%$search%")
                ->take(200)
                ->get();
        } else {
            $customers = Customer::where('client_id', Auth::user()->client_id)->select("id", "name", "mobile_no")
                ->orderBy('id', 'asc')
                ->take(200)
                ->get();
        }
        // dd($customers);
        return response()->json($customers);
    }

    public function getTransferProduct(Request $request)
    {
        $products = [];
        if ($request->has('q')) {
            $search = $request->q;
            $products = Product::where('client_id', Auth::user()->client_id)
                ->with(['productColor', 'productSize', 'productCategory', 'productUnit'])
                ->where(function ($q) use ($search) {
                    $q->where('code', 'LIKE', "%$search%")
                        ->orWhere('name', 'LIKE', "%$search%")
                        ->orWhereHas('productCategory', function ($sq) use ($search) {
                            $sq->where('name', 'LIKE', "%$search%");
                        });
                })
                ->orderBy('code', 'asc')
                ->take(200)
                ->get();
        } else {
            $products = Product::where('client_id', Auth::user()->client_id)
                ->with(['productColor', 'productSize', 'productCategory', 'productUnit'])
                ->orderBy('code', 'asc')
                ->take(200)
                ->get();
        }
        $product_ids = [];
        foreach ($products as $product) {
            if ($product->branchStockQuantity($request->company_branch_id) > 0) {
                array_push($product_ids, $product->id);
            }
        }
        $products = $products->whereIn('id', $product_ids);
        return response()->json($products);
    }

    public function getBranchProductStock(Request $request)
    {
        $product = Product::find($request->product_id);
        $stock = InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $request->product_id)->where('type', 1)->where('company_branch_id', $request->company_branch_id)->sum('quantity') - InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $request->product_id)->where('type', 2)->where('company_branch_id', $request->company_branch_id)->sum('quantity');
        return [
            'product' => $product,
            'stock' => $stock
        ];
    }

    public function getEmployees(Request $request)
    {
        $employees = [];
        if ($request->has('q')) {
            $search = $request->q;
            $employees = Employee::where('client_id', Auth::user()->client_id)->select("id", "name", "mobile_no")
                ->where('name', 'LIKE', "%$search%")
                ->take(200)
                ->get();
        } else {
            $employees = Employee::where('client_id', Auth::user()->client_id)->select("id", "name", "mobile_no")
                ->orderBy('id', 'asc')
                ->take(200)
                ->get();
        }
        // dd($employees);
        return response()->json($employees);
    }

    public function getBranchEmployees(Request $request)
    {
        $employees = [];
        if ($request->has('q')) {
            $search = $request->q;
            $employees = Employee::where('client_id', Auth::user()->client_id)->where('company_branch_id', $request->company_branch_id)->select("id", "name", "mobile_no")
                ->where('name', 'LIKE', "%$search%")
                ->take(200)
                ->get();
        } else {
            $employees = Employee::where('client_id', Auth::user()->client_id)->where('company_branch_id', $request->company_branch_id)->select("id", "name", "mobile_no")
                ->orderBy('id', 'asc')
                ->take(200)
                ->get();
        }
        // dd($employees);
        return response()->json($employees);
    }

    public function getProducts(Request $request)
    {
        $products = Product::where('client_id', Auth::user()->client_id);
        if ($request->has('q')) {
            $search = $request->q;
            $products = $products->where("status", 1)
                ->where('code', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->take(200)
                ->get();
        } else {
            $products = $products->where("status", 1)
                ->orderBy('id', 'asc')
                ->take(200)
                ->get();
        }
        // dd($products);
        return response()->json($products);
    }

    public function getProductsByCode(Request $request)
    {
        if ($request->has('term')) {
            return Product::with(['productColor', 'productSize', 'productCategory'])->where('client_id', Auth::user()->client_id)->where('code', 'like', '%' . $request->input('term') . '%')
                ->orWhere('name', 'like', '%' . $request->input('term') . '%')
                ->take(25)->get();
        }
    }

    public function getProductDetails(Request $request)
    {
        $product = Product::with('productCategory')->where('client_id', Auth::user()->client_id)->where('code', $request->code)->first();
        $inventory_log = InventoryLog::where('client_id', Auth::user()->client_id)->where('product_id', $product->id)->where('company_branch_id', $request->company_branch_id)->first();
        if ($product) {
            return response()->json(['success' => true, 'data' => $product, 'stock' => $inventory_log ? $inventory_log->stockQuantity() : 0]);
        } else {
            return response()->json(['success' => false, 'data' => null]);
        }
    }

    public function getSalaryMonth(Request $request)
    {
        $salary_month = SalaryProcess::where('client_id', Auth::user()->client_id)->where('year', $request->year)->where('company_branch_id', $request->company_branch_id)->pluck('month');
        $month = Month::whereNotIn('name', $salary_month)->get();
        return response()->json($month);
    }

    public function getMonthSalarySheet(Request $request)
    {
        $salary_month = SalaryProcess::where('client_id', Auth::user()->client_id)->where('year', $request->year)->where('company_branch_id', $request->company_branch_id)->pluck('month');
        $month = Month::whereIn('name', $salary_month)->get();
        return response()->json($month);
    }

    public function queryTest(Request $request)
    {
        $query = Student::query();

        dd($query->get());
    }
}
