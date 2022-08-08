<?php

namespace App\Http\Controllers;

use App\Models\CompanyBranch;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\ProductTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProductTransferController extends Controller
{
    public function productTransfers()
    {
        return view('product.product_transfer.all');
    }

    public function productTransferCreate()
    {
        $count = ProductTransfer::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $company_branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('product.product_transfer.create', compact(
            'invoice_no',
            'company_branches'
        ));
    }

    public function productTransferStore(Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->back()->with('success', 'Product transfer successfully done.');
    }


    public function productTransferDelete(ProductTransfer $product_transfer)
    {
        // Remove inventory log
        InventoryLog::where('product_transfer_id', $product_transfer->id)->delete();
        // Remove product transfer
        $product_transfer->delete();

        return redirect()->back()->with('success', 'Transfer product deleted.');
    }

    public function productTransferDatatable(Request $request)
    {
        $query = ProductTransfer::with(['productColor', 'productSize', 'productCategory'])->where('client_id', Auth::user()->client_id)->orderBy('id', 'desc');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('product_color', function (ProductTransfer $product_transfer) {
                return $product_transfer->productColor->name ?? '';
            })
            ->addColumn('product_size', function (ProductTransfer $product_transfer) {
                return $product_transfer->productSize->name ?? '';
            })
            ->addColumn('product_category', function (ProductTransfer $product_transfer) {
                return $product_transfer->productCategory->name ?? '';
            })
            ->addColumn('source_company_branch_name', function (ProductTransfer $product_transfer) {
                return $product_transfer->sourceCompanyBranch->name ?? '';
            })
            ->addColumn('target_company_branch_name', function (ProductTransfer $product_transfer) {
                return $product_transfer->targetCompanyBranch->name ?? '';
            })
            ->editColumn('date', function (ProductTransfer $product_transfer) {
                return $product_transfer->date->format('j F, Y');
            })
            ->addColumn('action', function (ProductTransfer $product_transfer) {
                $btn = '';
                $btn .= ' <a class="btn btn-danger btn-sm" href="' . route('product_transfer_delete', ['product_transfer' => $product_transfer->id]) . '" onclick="return confirm(\'Are you sure you want to delete ?\');"> Delete </a> ';
                return $btn;
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
