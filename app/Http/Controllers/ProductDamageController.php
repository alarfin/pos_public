<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\CompanyBranch;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductDamageController extends Controller
{
    public function productDamages()
    {
        return view('product.damage.damages');
    }

    public function productDamageCreate()
    {
        $count = InventoryLog::where('client_id', Auth::user()->client_id)->where('stock_type', 4)->groupBy('invoice_no')->withTrashed()->count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $company_branches = CompanyBranch::where(['client_id' => Auth::user()->client_id])->where('status', 1)->get();
        return view('product.damage.create', compact('invoice_no', 'company_branches'));
    }

    public function productDamageStore(Request $request)
    {
        dd('Remove Code for demo');



        return redirect()->route('product_damages');
    }

    public function productDamageDelete(InventoryLog $inventory_log)
    {
        dd('Remove Code for demo');

        return redirect()->back()->with('message', 'Damage product deleted successfully done.');
    }

    public function productDamageDatatable(Request $request)
    {
        $query = InventoryLog::where('client_id', Auth::user()->client_id)->where('stock_type', 4)->orderBy('id', 'desc');
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('date', function (InventoryLog $inventory_log) {
                return $inventory_log->date->format('j F, Y');
            })
            ->editColumn('total', function (InventoryLog $inventory_log) {
                return number_format($inventory_log->total, 2);
            })
            ->editColumn('unit_price', function (InventoryLog $inventory_log) {
                return number_format($inventory_log->unit_price, 2);
            })
            ->addColumn('action', function (InventoryLog $inventory_log) {
                $btn = '';
                if (Auth::user()->can('product_damage_delete')) {
                    $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('product_damage_delete', ['inventory_log' => $inventory_log->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                }

                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
