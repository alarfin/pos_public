<?php

namespace App\Http\Controllers;

use App\Models\CompanyBranch;
use App\Models\InventoryLog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    public function inventory()
    {
        return view('product.inventory.inventory');
    }

    public function inventoryDatatable(Request $request)
    {
        $query = InventoryLog::with(['product', 'productColor', 'productSize', 'productCategory', 'companyBranch', 'client'])
            ->where('client_id', Auth::user()->client_id)
            ->groupBy('product_id', 'company_branch_id');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('branch_name', function (InventoryLog $inventory_log) {
                return $inventory_log->companyBranch->name ?? '';
            })
            ->addColumn('name', function (InventoryLog $inventory_log) {
                return $inventory_log->product->name ?? '';
            })
            ->addColumn('product_color', function (InventoryLog $inventory_log) {
                return $inventory_log->product->productColor->name ?? '';
            })
            ->addColumn('product_size', function (InventoryLog $inventory_log) {
                return $inventory_log->product->productSize->name ?? '';
            })
            ->addColumn('product_category', function (InventoryLog $inventory_log) {
                return $inventory_log->product->productCategory->name ?? '';
            })
            ->addColumn('product_unit', function (InventoryLog $inventory_log) {
                return $inventory_log->product->productUnit->name ?? '';
            })
            ->addColumn('action', function (InventoryLog $inventory_log) {
                $btn = ' <a role="button" class="btn btn-primary btn-sm btn-barcode" data-id="' . $inventory_log->product->id . '" data-name="' . $inventory_log->product->code . "-" . $inventory_log->product->name . '"> Barcode </a> ';
                $btn .= ' <a role="button" class="btn btn-info btn-sm btn-qrcode" data-id="' . $inventory_log->product->id . '" data-name="' . $inventory_log->product->code . "-" . $inventory_log->product->name . '"> QR code </a> ';
                return $btn;
            })
            ->editColumn('quantity', function (InventoryLog $inventory_log) {
                if ($inventory_log->stockQuantity() > $inventory_log->product->minimum_alert) {
                    return number_format($inventory_log->stockQuantity(), 2);
                } else {
                    return '<span class="text-danger">' . number_format($inventory_log->stockQuantity(), 2) . '</span>';
                }
            })
            ->editColumn('total', function (InventoryLog $inventory_log) {
                if ($inventory_log->stockQuantity() > 0) {
                    return number_format($inventory_log->stockAmount(), 2);
                } else {
                    return number_format(0, 2);
                }
            })
            ->rawColumns(['action', 'quantity'])
            ->toJson();
    }
    public function inventoryDetails()
    {
        $branches = CompanyBranch::where('client_id', 1)->where('status', 1)->get();
        return view('product.inventory.inventory_details', compact('branches'));
    }

    public function inventoryDetailsDatatable(Request $request)
    {
        $query = InventoryLog::with(['product', 'productColor', 'productSize', 'productCategory', 'companyBranch', 'client'])->where('client_id', Auth::user()->client_id);
        if ($request->company_branch_id) {
            $query->where('company_branch_id', $request->company_branch_id);
        }
        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }
        if ($request->type) {
            $query->where('type', $request->type);
        }
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('date', [$request->start_date, $request->end_date]);
        }
        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->editColumn('date', function (InventoryLog $inventory_log) {
                return $inventory_log->date ? $inventory_log->date->format('d-m-Y') : '';
            })
            ->addColumn('product', function (InventoryLog $inventory_log) {
                return $inventory_log->product->name ?? '';
            })
            ->addColumn('branch_name', function (InventoryLog $inventory_log) {
                return $inventory_log->companyBranch->name ?? '';
            })
            ->addColumn('product_color', function (InventoryLog $inventory_log) {
                return $inventory_log->productColor->name ?? '';
            })
            ->addColumn('product_size', function (InventoryLog $inventory_log) {
                return $inventory_log->productSize->name ?? '';
            })
            ->addColumn('product_category', function (InventoryLog $inventory_log) {
                return $inventory_log->productCategory->name ?? '';
            })
            ->editColumn('type', function (InventoryLog $inventory_log) {
                if ($inventory_log->type == 1) {
                    return "<span class='label label-success'>In</span>";
                } else {
                    return "<span class='label label-danger'>Out</span>";
                }
            })
            // ->addColumn('action', function (InventoryLog $inventory_log) {
            //     $btn = ' <a href="' . route('inventory_details', ['product' => $inventory_log->id]) . '" class="btn btn-primary btn-sm"> Details </a> ';
            //     return $btn;
            // })
            ->editColumn('quantity', function (InventoryLog $inventory_log) {
                return number_format($inventory_log->quantity, 2);
            })
            ->editColumn('total', function (InventoryLog $inventory_log) {
                return number_format($inventory_log->total, 2);
            })
            ->rawColumns(['action', 'type'])
            ->toJson();
    }
}
