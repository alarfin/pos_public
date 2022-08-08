<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Bank;
use App\Models\CompanyBranch;
use App\Models\Customer;
use App\Models\InventoryLog;
use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\SaleOrderProduct;
use App\Models\TransactionLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use SakibRahaman\DecimalToWords\DecimalToWords;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    public function saleOrders()
    {
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('sale.sale_order.orders', compact('banks'));
    }

    public function saleOrderCreate()
    {
        $count = SaleOrder::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('sale.sale_order.create', compact('invoice_no', 'banks', 'branches'));
    }

    public function saleOrderStore(Request $request)
    {
        dd('Remove Code for demo');

        return redirect()->route('sale_order_details', ['sale_order' => $sale_order->id]);
    }

    public function saleOrderEdit(SaleOrder $sale_order)
    {
        $count = SaleOrder::where('client_id', Auth::user()->client_id)->withTrashed()->count();
        $invoice_no = str_pad($count + 1, 5, 0, STR_PAD_LEFT);
        $banks = Bank::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        $branches = CompanyBranch::where('client_id', Auth::user()->client_id)->where('status', 1)->get();
        return view('sale.sale_order.edit', compact(
            'invoice_no',
            'banks',
            'branches',
            'sale_order'
        ));
    }

    public function saleOrderUpdate(Request $request, SaleOrder $sale_order)
    {
        dd('Remove Code for demo');

        return redirect()->route('sale_order_details', ['sale_order' => $sale_order->id]);
    }

    public function saleOrderDetails(SaleOrder $sale_order)
    {
        return view('sale.sale_order.details', compact('sale_order'));
    }

    public function saleOrderPrint(SaleOrder $sale_order)
    {
        return view('sale.sale_ordre.print', compact('sale_order'));
    }


    public function saleOrderDelete(SaleOrder $sale_order)
    {
        $this->clientCheck($sale_order);
        // Remove Inventory Log
        InventoryLog::where('sale_order_id', $sale_order->id)->delete();
        // Remove Transaction Log
        TransactionLog::where('sale_order_id', $sale_order->id)->delete();
        // Remove Sale Order Product
        SaleOrderProduct::where('sale_order_id', $sale_order->id)->delete();
        // Remove Sale Receiveable
        TransactionLog::where('client_id', $sale_order->client_id)
            ->where('sale_order_id', $sale_order->id)
            ->where('account_id', 8)
            ->delete();
        // Remove Sale Order
        $sale_order->update(['delete_user_id' => Auth::id()]);
        $sale_order->delete();

        return redirect()->back()->with('message', 'Sale order deleted successfully done.');
    }

    public function saleOrderPayment(Request $request)
    {
        $rules = [
            'sale_order_id' => 'required',
            'payment_method' => 'required',
            'amount' => 'required|numeric|min:0',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ];

        if ($request->payment_method == '2') {
            $rules['bank_id'] = 'required';
        }

        if ($request->sale_order_id != '') {
            $sale_order = SaleOrder::find($request->sale_order_id);
            $rules['amount'] = 'required|numeric|min:0|max:' . $sale_order->due;
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

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()]);
        }

        $sale_order = SaleOrder::find($request->sale_order_id);
        $customer = Customer::find($sale_order->customer_id);
        $account = Account::find(1);

        if ($request->amount > 0) {
            $voucher_count = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            TransactionLog::create([
                'client_id' => Auth::user()->client_id,
                'voucher_no' => str_pad($voucher_count + 1, 5, 0, STR_PAD_LEFT),
                'transaction_type' => 4,
                'date' => date('Y-m-d', strtotime($request->date)),
                'particular' => "Customer payment for invoice no. " . $sale_order->invoice_no,
                'account_class_id' => $account->account_class_id,
                'account_head_id' => $account->account_head_id,
                'account_id' => $account->account_id,
                'customer_id' => $customer->id,
                'sale_order_id' => $sale_order->id,
                'payment_method' => $request->payment_method ?? null,
                'bank_id' => $request->bank_id ?? null,
                'credit' => $request->amount,
                'amount' => $request->amount,
                'note' => "Customer payment of " . $customer->name ?? null,
                'user_id' => Auth::id(),
                'status' => 1,
            ]);

            $receivable = Account::find(9);
            $voucher_count3 = TransactionLog::where('client_id', Auth::user()->client_id)->withTrashed()->count();
            $transaction_log = TransactionLog::where('client_id', $sale_order->client_id)
                ->where('sale_order_id', $sale_order->id)
                ->where('account_id', 8)
                ->first();
            if ($transaction_log) {
                $transaction_log->update([
                    'debit' => $request->amount,
                    'amount' => $request->amount,
                ]);
            } else {
                TransactionLog::create([
                    'client_id' => Auth::user()->client_id,
                    'company_branch_id' => $request->company_branch_id,
                    'voucher_no' => str_pad($voucher_count3 + 1, 5, 0, STR_PAD_LEFT),
                    'transaction_type' => 4,
                    'date' => date('Y-m-d', strtotime($request->date)),
                    'particular' => "Customer receivable for invoice no. " . $sale_order->invoice_no,
                    'account_class_id' => $receivable->account_class_id,
                    'account_head_id' => $receivable->account_head_id,
                    'account_id' => $receivable->id,
                    'customer_id' => $customer->id,
                    'sale_order_id' => $sale_order->id,
                    'payment_method' => null,
                    'bank_id' => null,
                    'debit' => $request->amount,
                    'amount' => $request->amount,
                    'note' => "Sale receivable from" . $customer->name ?? null,
                    'user_id' => Auth::id(),
                    'status' => 1,
                ]);
            }
        }

        $sale_order->increment('paid', $request->amount);
        $sale_order->decrement('due', $request->amount);

        return response()->json(['success' => true, 'message' => 'Payment has been completed.']);
    }

    public function saleOrderDatatable(Request $request)
    {
        $query = SaleOrder::with(['customer'])->where('client_id', Auth::user()->client_id)->orderBy('id', 'desc');

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('customer_name', function (SaleOrder $sale_order) {
                return $sale_order->customer->name ?? '';
            })
            ->addColumn('customer_mobile_no', function (SaleOrder $sale_order) {
                return $sale_order->customer->mobile_no ?? '';
            })
            ->addColumn('action', function (SaleOrder $sale_order) {
                // return '<a href="'.route('sale_receipt.details', ['order' => $sale_order->id]).'" class="btn btn-primary btn-sm">View</a> <a href="'.route('sale_receipt.qr_code', ['order' => $sale_order->id]).'" class="btn btn-success btn-sm">QR Code</a> <a href="'.route('sale_receipt.edit', ['order' => $sale_order->id]).'" class="btn btn-info btn-sm">Edit</a>';
                $btn = ' <a href="' . route('sale_order_details', ['sale_order' => $sale_order->id]) . '" class="btn btn-primary btn-sm">View</a> ';
                if (Auth::user()->can('sale_edit')) {
                    $btn .= ' <a href="' . route('sale_order_edit', ['sale_order' => $sale_order->id]) . '" class="btn btn-info btn-sm">Edit</a> ';
                }


                if (Auth::user()->can('customer_payment') && $sale_order->due > 0) {
                    $btn .= ' <a role="button" class="btn btn-success btn-sm btn-pay" data-id="' . $sale_order->id . '" data-name="' . $sale_order->customer->name . '" data-amount="' . $sale_order->due . '"> Pay </a> ';
                }

                if (Auth::user()->can('sale_delete')) {
                    $btn .= ' <a href="' . route('sale_order_delete', ['sale_order' => $sale_order->id]) . '" class="btn btn-danger btn-sm" onclick="return confirm(\'Are you sure you want to delete ?\');">Delete</a> ';
                }

                return $btn;
            })
            ->editColumn('date', function (SaleOrder $sale_order) {
                return $sale_order->date->format('j F, Y');
            })
            ->editColumn('total', function (SaleOrder $sale_order) {
                return number_format($sale_order->total, 2);
            })
            ->editColumn('paid', function (SaleOrder $sale_order) {
                return number_format($sale_order->paid, 2);
            })
            ->editColumn('due', function (SaleOrder $sale_order) {
                return number_format($sale_order->due, 2);
            })
            ->rawColumns(['action'])
            ->toJson();
    }
}
