<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\InventoryLog;
use App\Models\OnlineInformation;
use App\Models\Photocopy;
use App\Models\TransactionLog;
use App\Models\SaleOrder;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['today_sale'] = SaleOrder::where('client_id', Auth::user()->client_id)->whereDate('date', date('Y-m-d'))->sum('total');
        $data['today_paid_sale'] = SaleOrder::where('client_id', Auth::user()->client_id)->whereDate('date', date('Y-m-d'))->sum('paid');
        $data['today_due_sale'] = SaleOrder::where('client_id', Auth::user()->client_id)->whereDate('date', date('Y-m-d'))->sum('due');

        $data['total_sale'] = SaleOrder::where('client_id', Auth::user()->client_id)->sum('total');
        $data['total_paid_sale'] = SaleOrder::where('client_id', Auth::user()->client_id)->sum('paid');
        $data['total_due_sale'] = SaleOrder::where('client_id', Auth::user()->client_id)->sum('due');

        $data['latest_sale_orders'] = SaleOrder::where('client_id', Auth::user()->client_id)->take(5)->orderBy('id', 'desc')->get();
        $data['latest_purchase_orders'] = PurchaseOrder::where('client_id', Auth::user()->client_id)->take(5)->orderBy('id', 'desc')->get();

        // Order Count By Month
        $startDate = [];
        $endDate = [];
        $saleAmountLabel = [];
        $saleAmount = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now();
            $saleAmountLabel[] = $date->startOfMonth()->subMonths($i)->format('M, Y');
            $startDate[] = $date->format('Y-m-d');
            $endDate[] = $date->endOfMonth()->format('Y-m-d');
        }

        for ($i = 0; $i < 12; $i++) {
            $saleAmount[] = SaleOrder::where('date', '>=', $startDate[$i])
                ->where('date', '<=', $endDate[$i])
                ->sum('total');
        }
        // Product Upload chart
        $orderCount = [];
        for ($i = 0; $i < 12; $i++) {
            $orderCount[] = SaleOrder::where('date', '>=', $startDate[$i])
                ->where('date', '<=', $endDate[$i])
                ->count();
        }
        $data['sale_amount_label'] = json_encode($saleAmountLabel);
        $data['sale_amount'] = json_encode($saleAmount);
        $data['order_count'] = json_encode($orderCount);
        // dd($data);
        return view('dashboard', $data);
    }
}
