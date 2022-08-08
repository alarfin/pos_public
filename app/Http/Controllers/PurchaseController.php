<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductUnit;
use App\Models\PurchaseInventoryLog;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderProduct;
use App\Models\Supplier;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    public function purchaseOrders()
    {
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('purchase.purchase_order.orders', compact('banks'));
    }

    public function purchaseOrderCreate()
    {
        $count = PurchaseOrder::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_categories = ProductCategory::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_brands = ProductBrand::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_units = ProductUnit::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_colors = ProductColor::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $product_sizes = ProductSize::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $last_code = Product::orderBy('id', 'desc')->where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $code = str_pad($last_code + 1, 5, 0, STR_PAD_LEFT);
        return view('purchase.purchase_order.create', compact(
            'invoice_no',
            'banks',
            'branches',
            'product_categories',
            'product_brands',
            'product_units',
            'product_colors',
            'product_sizes',
            'code'
        ));
    }

    public function purchaseOrderStore(Request $request)
    {
        $request->validate([
            'company_branch_id' => 'required',
            'supplier' => 'required',
            'date' => 'required|date',
            'code.*' => 'required',
            'product.*' => 'required',
            'quantity.*' => 'required|numeric|min:.01',
            'unit_price.*' => 'required|numeric|min:0',
            'selling_price.*' => 'required|numeric|min:0',
        ]);

        $count = PurchaseOrder::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $supplier = Supplier::find($request->supplier);

        $purchase_order = new PurchaseOrder();
        $purchase_order->client_id = Auth::user()->client_id;
        $purchase_order->company_branch_id = $request->company_branch_id;
        $purchase_order->invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $purchase_order->supplier_id = $request->supplier;
        $purchase_order->date = date('Y-m-d', strtotime($request->date));
        $purchase_order->payment_method = $request->payment_method;
        $purchase_order->sub_total = 0;
        $purchase_order->discount = 0;
        $purchase_order->total = 0;
        $purchase_order->paid = 0;
        $purchase_order->due = 0;
        $purchase_order->note = $request->note;
        $purchase_order->user_id = Auth::id();
        $purchase_order->save();

        $sub_total = 0;
        foreach ($request->code as $key => $product_code) {
            $product = Product::where('client_id', Auth::user()->client_id)->where('code', $product_code)->first();
            if ($product) {
                $product->update(['sale_price' => $request->selling_price[$key]]);
                // Inventory Log
                $inventory_log = InventoryLog::create([
                    'client_id' => Auth::user()->client_id,
                    'company_branch_id' => $request->company_branch_id,
                    'product_id' => $product->id,
                    'product_color_id' => $product->product_color_id,
                    'product_size_id' => $product->product_size_id,
                    'product_category_id' => $product->product_category_id,
                    'code' => $product_code,
                    'stock_type' => 1,
                    'type' => 1,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'discount' => 0,
                    'serial_no' => $request->serial_no[$key] ?? null,
                    'quantity' => $request->quantity[$key],
                    'unit_price' => $request->unit_price[$key],
                    'buy_price' => $request->unit_price[$key],
                    'product_total' => $request->quantity[$key] * $request->unit_price[$key],
                    'buy_total' => $request->quantity[$key] * $request->unit_price[$key],
                    'total' => $request->quantity[$key] * $request->unit_price[$key],
                    'supplier_id' => $request->supplier,
                    'purchase_order_id' => $purchase_order->id,
                    'note' => "Purchase Product In",
                    'user_id' => Auth::id(),
                ]);

                // Purchase Order Product save
                $purchase_order_product = PurchaseOrderProduct::create([
                    'client_id' => Auth::user()->client_id,
                    'company_branch_id' => $request->company_branch_id,
                    'purchase_order_id' => $purchase_order->id,
                    'product_id' => $product->id,
                    'product_color_id' => $product->product_color_id,
                    'product_size_id' => $product->product_size_id,
                    'product_category_id' => $product->product_category_id,
                    'supplier_id' => $request->supplier,
                    'inventory_log_id' => $inventory_log->id,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'name' => $product->name,
                    'code' => $product_code,
                    'discount' => 0,
                    'serial_no' => $request->serial_no[$key] ?? null,
                    'quantity' => $request->quantity[$key],
                    'unit_price' => $request->unit_price[$key],
                    'product_total' => $request->quantity[$key] * $request->unit_price[$key],
                    'total' => $request->quantity[$key] * $request->unit_price[$key],
                    'user_id' => Auth::id(),
                ]);

                $sub_total += $request->quantity[$key] * $request->unit_price[$key];
            }
        }

        $discount = $request->discount;
        $is_percentage = substr($discount, -1);
        if ($is_percentage == '%') {
            $percentage = substr($discount, 0, -1);
            $discount = (200 * $percentage) / 100;
        }
        $discount = floatval($discount);

        $purchase_order->sub_total = $sub_total;
        $purchase_order->discount = $discount;
        $purchase_order->total = $sub_total - $discount;
        $purchase_order->paid = $request->paid;
        $purchase_order->due = $sub_total - $discount - $request->paid;
        $purchase_order->save();

        if ($discount > 0) {
            $avg_discount = $discount / count($purchase_order->products ?? []);
            foreach ($purchase_order->products ?? [] as $order_product) {
                $order_product->update([
                    'discount' => $avg_discount,
                    'total' => $order_product->product_total - $avg_discount,
                ]);
            }
            foreach ($purchase_order->inventoryLogs ?? [] as $order_inventory) {
                $order_inventory->update([
                    'discount' => $avg_discount,
                    'buy_total' => $order_inventory->product_total - $avg_discount,
                    'total' => $order_inventory->product_total - $avg_discount,
                ]);
            }
        }


        // Purchase Credit
        $account = Account::find(1);
        $voucher_count = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        TransactionLog::create([
            'client_id' => Auth::user()->client_id,
            'company_branch_id' => $request->company_branch_id,
            'voucher_no' => str_pad($voucher_count + 1, 5, 0, STR_PAD_LEFT),
            'transaction_type' => 3,
            'date' => date('Y-m-d', strtotime($request->date)),
            'particular' => "Purchase of invoice no. " . $purchase_order->invoice_no,
            'account_class_id' => $account->account_class_id,
            'account_head_id' => $account->account_head_id,
            'account_id' => $account->id,
            'supplier_id' => $supplier->id,
            'purchase_order_id' => $purchase_order->id,
            'payment_method' => null,
            'bank_id' => null,
            'credit' => $purchase_order->total,
            'amount' => $purchase_order->total,
            'note' => "Purchase from " . $supplier->name ?? null,
            'user_id' => Auth::id(),
            'status' => 1,
        ]);

        // Purchase Payment
        if ($request->payment_method == 1) {
            $payment_account = Account::find(3);
        } elseif ($request->payment_method == 2) {
            $payment_account = Account::find(4);
        } else {
            $payment_account = Account::find(5);
        }

        if ($request->paid > 0) {
            $voucher_count2 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $request->company_branch_id,
                'voucher_no' => str_pad($voucher_count2 + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => 2,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Supplier payment for invoice no. " . $purchase_order->invoice_no,
                'account_class_id' => $payment_account->account_class_id,
                'account_head_id' => $payment_account->account_head_id,
                'account_id' => $payment_account->id,
                'supplier_id' => $supplier->id,
                'purchase_order_id' => $purchase_order->id,
                'payment_method' => $request->payment_method ?? null,
                'bank_id' => $request->bank_id ?? null,
                'debit' => $request->paid,
                'amount' => $request->paid,
                'note' => "Purchase payment for " . $supplier->name ?? null,
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }

        if ($request->paid != $purchase_order->total) {
            $amount = $purchase_order->total - $request->paid;
            $payable = Account::find(8);
            $voucher_count3 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $request->company_branch_id,
                'voucher_no' => str_pad($voucher_count3 + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => 3,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Purchase payable for invoice no. " . $purchase_order->invoice_no,
                'account_class_id' => $payable->account_class_id,
                'account_head_id' => $payable->account_head_id,
                'account_id' => $payable->id,
                'supplier_id' => $supplier->id,
                'purchase_order_id' => $purchase_order->id,
                'payment_method' => null,
                'bank_id' => null,
                'credit' => $amount,
                'amount' => $amount,
                'note' => "Purchase payable from " . $supplier->name ?? null,
                'user_id' => Auth::id(),
                'status' => 1,
            ]);
        }

        return redirect()->route('purchase_order_details', ['purchase_order' => $purchase_order->id]);
    }

    public function purchaseOrderEdit(PurchaseOrder $purchase_order)
    {
        $this->clientCheck($purchase_order);
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('purchase.purchase_order.edit', compact('purchase_order', 'banks', 'branches'));
    }

    public function purchaseOrderUpdate(Request $request, PurchaseOrder $purchase_order)
    {
        dd('Remove Code for demo');


        return redirect()->route('purchase_order_details', ['purchase_order' => $purchase_order->id]);
    }

    public function purchaseOrderDetails(PurchaseOrder $purchase_order)
    {
        return view('purchase.purchase_order.details', compact('purchase_order'));
    }

    public function purchaseOrderPrint(PurchaseOrder $purchase_order)
    {
        return view('purchase.purchase_ordre.print', compact('purchase_order'));
    }

    public function purchaseOrderPayment(Request $request)
    {
        $rules = [
            'purchase_order_id' => 'required',
            'payment_method' => 'required',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ];

        if ($request->payment_method == '2') {
            $rules['bank_id'] = 'required';
        }

        if ($request->purchase_order_id != '') {
            $purchase_order = PurchaseOrder::find($request->purchase_order_id);
            $rules['amount'] = 'required|numeric|min:0|max:' . $purchase_order->due;
        }

        $validator = Validator::make($request->all(), $rules);

        // $validator->after(function ($validator) use ($request) {
        //     if ($request->payment_method == 1) {
        //         $cashBalance = Account::find(3)->balance();
        //         if ($request->amount > $cashBalance)
        //             $validator->errors()->add('amount', 'Insufficient balance.');
        //     } else {
        //         if ($request->bank_id != '') {
        //             $bankBalance = Bank::find($request->bank_id)->balance;
        //             if ($request->amount > $bankBalance)
        //                 $validator->errors()->add('amount', 'Insufficient balance.');
        //         }
        //     }
        // });
        return response()->json(['success' => false, 'message' => 'Remove code for demo']);
        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        // $purchase_order = PurchaseOrder::find($request->purchase_order_id);
        $supplier = Supplier::find($purchase_order->supplier_id);

        // Purchase Payment
        if ($request->payment_method == 1) {
            $payment_account = Account::find(3);
        } elseif ($request->payment_method == 2) {
            $payment_account = Account::find(4);
        } else {
            $payment_account = Account::find(5);
        }

        if ($request->amount > 0) {
            $voucher_count = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'company_branch_id' => $purchase_order->company_branch_id,
                'voucher_no' => str_pad($voucher_count + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => 2,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Supplier payment for invoice no. " . $purchase_order->invoice_no,
                'account_class_id' => $payment_account->account_class_id,
                'account_head_id' => $payment_account->account_head_id,
                'account_id' => $payment_account->id,
                'supplier_id' => $supplier->id,
                'purchase_order_id' => $purchase_order->id,
                'payment_method' => $request->payment_method ?? null,
                'bank_id' => $request->bank_id ?? null,
                'debit' => $request->amount,
                'amount' => $request->amount,
                'note' => "Supplier payment of " . $supplier->name ?? null,
                'user_id' => Auth::id(),
                'status' => 1,
            ]);


            $payable = Account::find(8);
            $voucher_count3 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            $purchase_payable = TransactionLog::where('client_id', $purchase_order->client_id)
                ->where('purchase_order_id', $purchase_order->id)
                ->where('account_id', 8)
                ->first();
            if ($purchase_payable) {
                $purchase_payable->credit = $purchase_payable->credit - $request->amount;
                $purchase_payable->amount = $purchase_payable->amount - $request->amount;
                $purchase_payable->save();
            } else {
                TransactionLog::create([
                    'client_id' => Auth::user()->client_id,
                    'company_branch_id' => $request->company_branch_id,
                    'voucher_no' => str_pad($voucher_count3 + 1, 5, 0, STR_PAD_LEFT),
                    'transaction_type' => 3,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'particular' => "Purchase payable for invoice no. " . $purchase_order->invoice_no,
                    'account_class_id' => $payable->account_class_id,
                    'account_head_id' => $payable->account_head_id,
                    'account_id' => $payable->id,
                    'supplier_id' => $supplier->id,
                    'purchase_order_id' => $purchase_order->id,
                    'payment_method' => null,
                    'bank_id' => null,
                    'credit' => $request->amount,
                    'amount' => $request->amount,
                    'note' => "Purchase payable from " . $supplier->name ?? null,
                    'user_id' => Auth::id(),
                    'status' => 1,
                ]);
            }
        }

        $purchase_order->increment('paid', $request->amount);
        $purchase_order->decrement('due', $request->amount);

        return response()->json(['success' => true, 'message' => 'Payment has been completed.']);
    }

    public function purchaseOrderDatatable(Request $request)
    {
        $query = PurchaseOrder::with(['supplier'])->where('client_id', Auth::user()->client_id)->orderBy('id', 'desc');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('supplier_name', function (PurchaseOrder $purchase_order) {
                return $purchase_order->supplier->name ?? '';
            })
            ->addColumn('supplier_mobile_no', function (PurchaseOrder $purchase_order) {
                return $purchase_order->supplier->mobile_no ?? '';
            })
            ->addColumn('action', function (PurchaseOrder $purchase_order) {
                // return '<a href="'.route('purchase_receipt.details', ['order' => $purchase_order->id]).'" class="btn btn-primary btn-sm">View</a> <a href="'.route('purchase_receipt.qr_code', ['order' => $purchase_order->id]).'" class="btn btn-success btn-sm">QR Code</a> <a href="'.route('purchase_receipt.edit', ['order' => $purchase_order->id]).'" class="btn btn-info btn-sm">Edit</a>';
                $btn = ' <a href="' . route('purchase_order_details', ['purchase_order' => $purchase_order->id]) . '" class="btn btn-primary btn-sm">View</a> ';
                if (Auth::user()->can('purchase_edit')) {
                    $btn .= ' <a href="' . route('purchase_order_edit', ['purchase_order' => $purchase_order->id]) . '" class="btn btn-info btn-sm">Edit</a> ';
                }

                if (Auth::user()->can('supplier_payment') && $purchase_order->due > 0) {
                    $btn .= ' <a role="button" class="btn btn-success btn-sm btn-pay" data-id="' . $purchase_order->id . '" data-name="' . $purchase_order->supplier->name . '" data-amount="' . $purchase_order->due . '"> Pay </a> ';
                }

                return $btn;
            })
            ->editColumn('date', function (PurchaseOrder $purchase_order) {
                return $purchase_order->date->format('j F, Y');
            })
            ->editColumn('total', function (PurchaseOrder $purchase_order) {
                return number_format($purchase_order->total, 2);
            })
            ->editColumn('paid', function (PurchaseOrder $purchase_order) {
                return number_format($purchase_order->paid, 2);
            })
            ->editColumn('due', function (PurchaseOrder $purchase_order) {
                return number_format($purchase_order->due, 2);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
