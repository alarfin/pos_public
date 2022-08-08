<?php

namespace App\Http\Controllers;

use App\Models\InventoryLog;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderProduct;
use App\Models\SaleOrder;
use App\Models\SaleOrderProduct;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnController extends Controller
{
    public function purchaseReturn(Request $request)
    {
        $purchase_order = null;
        if ($request->invoice_no) {
            $purchase_order = PurchaseOrder::where('client_id', Auth::user()->client_id)->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT))->first();
        }
        return view('purchase.return.create', compact('purchase_order'));
    }
    public function purchaseReturnStore(Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->back()->with('success', 'Purchase product return successfully done.');
        // return redirect()->route('purchase_return')->with('success', 'Purchase product return successfully done.');
    }

    public function saleReturn(Request $request)
    {
        $sale_order = null;
        if ($request->invoice_no) {
            $sale_order = SaleOrder::where('client_id', Auth::user()->client_id)->where('invoice_no', str_pad($request->invoice_no, 5, 0, STR_PAD_LEFT))->first();
        }
        return view('sale.return.create', compact('sale_order'));
    }

    public function saleReturnStore(Request $request)
    {
        $this->validate($request, [
            'sale_order_id' => 'required',
            'return_quantity' => 'required',
            'return_quantity.*' => 'required|numeric|min:0',
        ]);
        $sale_order = SaleOrder::where('client_id', Auth::user()->client_id)->find($request->sale_order_id);
        $sale_order->paid =  $sale_order->paid - $request->return_amount ?? 0;
        $sale_order->save();

        $remove_discount = 0;
        $discount = 0;
        $total = 0;

        foreach ($request->sale_order_product_ids ?? [] as $key => $sale_order_product_id) {
            $order_product = SaleOrderProduct::where('client_id', Auth::user()->client_id)->find($sale_order_product_id);
            if ($request->return_quantity[$key] > 0) {
                // Inventory log
                $inventory_log = InventoryLog::find($order_product->inventory_log_id);
                $inventory_log->return_quantity = $inventory_log->return_quantity + $request->return_quantity[$key];
                $inventory_log->quantity = $inventory_log->quantity - $request->return_quantity[$key];
                $inventory_log->save();

                // order product
                $order_product->return_quantity = $order_product->return_quantity + $request->return_quantity[$key];
                $order_product->quantity = $order_product->quantity - $request->return_quantity[$key];
                $order_product->return_at = now();
                $order_product->return_total = $order_product->return_quantity * $order_product->unit_price;
                $order_product->save();
                if ($order_product->quantity <= 0) {
                    $remove_discount += $order_product->product_discount;
                    $discount += $order_product->discount;
                    $order_product->total = 0;
                    $order_product->product_discount = 0;
                } else {
                    $order_product->total = ($order_product->quantity * $order_product->unit_price) - $order_product->product_discount + $order_product->tax + $order_product->vat;
                }
                $order_product->save();
            }
            $total += $order_product->total;
        }

        $sale_order->product_discount = $sale_order->product_discount - $remove_discount;
        $sale_order->total = $total - $sale_order->discount;
        $sale_order->due = $total - $sale_order->paid;
        $sale_order->return_total = $sale_order->return_total + $request->return_amount;
        $sale_order->save();

        // Update Sale Log
        $transaction_log = TransactionLog::where('client_id', Auth::user()->client_id)->where('sale_order_id', $sale_order->id)->where('account_id', 2)->first();
        $transaction_log->credit = $sale_order->total;
        $transaction_log->amount = $sale_order->total;
        $transaction_log->save();

        // Update Sale receivable
        $sale_receivable = TransactionLog::where('client_id', Auth::user()->client_id)->where('sale_order_id', $sale_order->id)->where('account_id', 8)->first();
        if ($sale_receivable) {
            $sale_receivable->credit = $sale_order->due;
            $sale_receivable->amount = $sale_order->due;
            $sale_receivable->save();
        }

        if ($request->return_amount > 0) {
            // Update Purchase Paid
            $sale_payment = TransactionLog::where('client_id', Auth::user()->client_id)->where('sale_order_id', $sale_order->id)->whereNotIn('account_id', [1, 8])->first();
            $sale_payment->debit = $sale_payment->debit - $request->return_amount;
            $sale_payment->amount = $sale_payment->amount - $request->return_amount;
            $sale_payment->save();
        }

        return redirect()->back()->with('success', 'Sale product return successfully done.');
        // return redirect()->route('sale_return')->with('success', 'Sale product return successfully done.');
    }
}
