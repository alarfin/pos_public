<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\Customer;
use App\Models\PriceQuotation;
use App\Models\PriceQuotationProduct;
use App\Models\Product;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PriceQuotationController extends Controller
{
    public function priceQuotations()
    {
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('price_quotation.orders', compact('banks'));
    }

    public function priceQuotationCreate()
    {
        $count = PriceQuotation::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('price_quotation.create', compact('invoice_no', 'banks', 'branches'));
    }

    public function priceQuotationStore(Request $request)
    {
        $request->validate([
            'company_branch_id' => 'required',
            'customer' => 'required',
            'date' => 'required|date',
            'code' => 'required',
            'code.*' => 'required',
            'product.*' => 'required',
            'quantity.*' => 'required|numeric',
            'unit_price.*' => 'required|numeric|min:0',
            'buy_price.*' => 'required|numeric|min:0',
        ]);

        $count = PriceQuotation::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $customer = Customer::find($request->customer);

        $price_quotation = new PriceQuotation();
        $price_quotation->client_id = Auth::user()->client_id;
        $price_quotation->company_branch_id = $request->company_branch_id;
        $price_quotation->invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $price_quotation->customer_id = $request->customer;
        $price_quotation->date = date('Y-m-d', strtotime($request->date));
        $price_quotation->payment_method = $request->payment_method;
        $price_quotation->product_discount = 0;
        $price_quotation->discount = 0;
        $price_quotation->total_discount = 0;
        $price_quotation->tax = $request->tax;
        $price_quotation->vat = $request->vat;
        $price_quotation->product_sub_total = 0;
        $price_quotation->sub_total = 0;
        $price_quotation->total = 0;
        $price_quotation->paid = 0;
        $price_quotation->due = 0;
        $price_quotation->note = $request->note;
        $price_quotation->user_id = Auth::id();
        $price_quotation->save();

        $sub_total = 0;
        $product_sub_total = 0;
        $total_product_discount = 0;
        $total_discount = 0;
        $total_vat = 0;
        $total_tax = 0;

        foreach ($request->code as $key => $product_code) {
            $product = Product::where('client_id', Auth::user()->client_id)->where('code', $product_code)->first();
            if ($product) {
                $product_total = $request->quantity[$key] * $request->unit_price[$key];
                $product_discount = $request->product_discount[$key];
                $is_product_percentage = substr($product_discount, -1);
                if ($is_product_percentage == '%') {
                    $product_percentage = substr($product_discount, 0, -1);
                    $product_discount = ($product_total * $product_percentage) / 100;
                }
                $product_discount = floatval($product_discount ?? 0);
                $tax = (($request->quantity[$key] * $request->unit_price[$key]) * $product->tax) / 100;
                $vat = (($request->quantity[$key] * $request->unit_price[$key]) * $product->vat) / 100;

                // sale Order Product save
                $price_quotation_product = PriceQuotationProduct::create([
                    'client_id' => Auth::user()->client_id,
                    'company_branch_id' => $request->company_branch_id,
                    'price_quotation_id' => $price_quotation->id,
                    'product_id' => $product->id,
                    'product_category_id' => $product->product_category_id,
                    'customer_id' => $request->customer,
                    'inventory_log_id' => null,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'name' => $product->name,
                    'code' => $product_code,
                    'warranty' => $product->warranty,
                    'guarantee' => $product->guarantee,
                    'product_discount' => $product_discount,
                    'discount' => $product_discount,
                    'tax' => $tax,
                    'tax_percentage' => $request->product_tax[$key] ?? 0,
                    'vat' => $vat,
                    'vat_percentage' => $request->product_vat[$key] ?? 0,
                    'serial_no' => $request->serial_no[$key] ?? null,
                    'quantity' => $request->quantity[$key],
                    'unit_price' => $request->unit_price[$key],
                    'buy_price' => $request->buy_price[$key],
                    'product_total' => $product_total,
                    'buy_total' => ($request->quantity[$key] * $request->unit_price[$key]),
                    'total' => ($product_total + $tax + $vat - $product_discount),
                    'user_id' => Auth::id(),
                ]);

                $sub_total += ($product_total + $tax + $vat - $product_discount);
                $product_sub_total += $product_total;
                $total_product_discount += $product_discount;
                $total_discount += $product_discount;
                $total_vat += $vat;
                $total_tax += $tax;
            }
        }

        $discount = $request->discount;
        $is_percentage = substr($discount, -1);
        if ($is_percentage == '%') {
            $percentage = substr($discount, 0, -1);
            $discount = ($sub_total * $percentage) / 100;
        }
        $discount = floatval($discount ?? 0);

        $price_quotation->product_discount = $total_product_discount;
        $price_quotation->discount = $discount;
        $price_quotation->total_discount = $total_product_discount + $discount;
        $price_quotation->tax = $total_tax;
        $price_quotation->vat = $total_vat;
        $price_quotation->product_sub_total = $product_sub_total;
        $price_quotation->sub_total = $sub_total;
        $price_quotation->total = $sub_total - $discount;
        $price_quotation->paid = 0;
        $price_quotation->due = $sub_total - $discount;
        $price_quotation->save();

        if ($discount > 0) {
            $avg_discount = $discount / count($price_quotation->products ?? []);
            foreach ($price_quotation->products ?? [] as $quatation_product) {
                $quatation_product->update([
                    'discount' => $quatation_product->product_discount + $avg_discount,
                    'total' => $quatation_product->total - $avg_discount,
                ]);
            }
        }

        return redirect()->route('price_quotation_details', ['price_quotation' => $price_quotation->id]);
    }

    public function priceQuotationEdit(PriceQuotation $price_quotation)
    {
        $count = PriceQuotation::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('price_quotation.edit', compact('invoice_no', 'banks', 'branches', 'price_quotation'));
    }

    public function priceQuotationUpdate(Request $request, PriceQuotation $price_quotation)
    {
        dd('Remove Code for demo');

        return redirect()->route('price_quotation_details', ['price_quotation' => $price_quotation->id]);
    }

    public function priceQuotationDetails(PriceQuotation $price_quotation)
    {
        return view('price_quotation.details', compact('price_quotation'));
    }

    public function priceQuotationPrint(PriceQuotation $price_quotation)
    {
        return view('price_quotaion.print', compact('price_quotation'));
    }


    public function priceQuotationDelete(PriceQuotation $price_quotation)
    {
        dd('Remove Code for demo');

        return redirect()->back()->with('message', 'Price quotation deleted successfully done.');
    }


    public function priceQuotationDatatable(Request $request)
    {
        $query = PriceQuotation::with(['customer', 'companyBranch'])->where('client_id', Auth::user()->client_id)->orderBy('id', 'desc');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('branch_name', function (PriceQuotation $price_quotation) {
                return $price_quotation->companyBranch->name ?? '';
            })
            ->addColumn('customer_name', function (PriceQuotation $price_quotation) {
                return $price_quotation->customer->name ?? '';
            })
            ->addColumn('customer_mobile_no', function (PriceQuotation $price_quotation) {
                return $price_quotation->customer->mobile_no ?? '';
            })
            ->addColumn('action', function (PriceQuotation $price_quotation) {
                $btn = '';
                // return '<a href="'.route('sale_receipt.details', ['order' => $price_quotation->id]).'" class="btn btn-primary btn-sm">View</a> <a href="'.route('sale_receipt.qr_code', ['order' => $price_quotation->id]).'" class="btn btn-success btn-sm">QR Code</a> <a href="'.route('sale_receipt.edit', ['order' => $price_quotation->id]).'" class="btn btn-info btn-sm">Edit</a>';
                $btn .= ' <a href="' . route('price_quotation_details', ['price_quotation' => $price_quotation->id]) . '" class="btn btn-primary btn-sm">View</a> ';
                if (Auth::user()->can('price_quotation_edit')) {
                    $btn .= ' <a href="' . route('price_quotation_edit', ['price_quotation' => $price_quotation->id]) . '" class="btn btn-info btn-sm">Edit</a> ';
                }
                if (Auth::user()->can('price_quotation_delete')) {
                    $btn .= ' <a href="' . route('price_quotation_delete', ['price_quotation' => $price_quotation->id]) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete ?\');">Delete</a> ';
                }



                return $btn;
            })
            ->editColumn('date', function (PriceQuotation $price_quotation) {
                return $price_quotation->date->format('j F, Y');
            })
            ->editColumn('total', function (PriceQuotation $price_quotation) {
                return number_format($price_quotation->total, 2);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
