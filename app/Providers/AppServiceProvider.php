<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\SaleOrder;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $nextPayments = SaleOrder::where('date', date('Y-m-d'))->get();
            $stocks = Product::inRandomOrder()->limit(3)->get();

            $data = [
                'nextPayments' => $nextPayments,
                'stocks' => $stocks,
            ];
            $setting = Setting::where('client_id', Auth::user()->client_id ?? 0)->first();
            $view->with('layoutData', $data)
                ->with('setting', $setting);
        });
    }
}
