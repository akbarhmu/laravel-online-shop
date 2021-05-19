<?php

namespace App\Providers;

use App\Models\Shop;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path() . '/Helpers/UserHelper.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('isAdmin', function() {
            return "<?php if(Auth::user()->isAdmin: ?>";
        });

        Blade::directive('endisAdmin', function() {
            return "<?php endif; ?>";
        });

        Blade::directive('rupiah', function ($expression) {
            return "Rp. <?php echo number_format($expression, 0, ',', '.'); ?>";
        });

        // Global Variables
        $shop = Shop::join('cities','shops.city_id','=','cities.id')
                        ->join('provinces','shops.province_id','=','provinces.id')
                        ->select('shops.*', 'cities.city_name', 'provinces.province as province_name')
                        ->where('shops.id','=', 1)
                        ->first();
        View::share('site_title', $shop->name);
        View::share('site_address', $shop->address);
        View::share('site_subdistrict', $shop->subdistrict);
        View::share('site_city_name', $shop->city_name);
        View::share('site_province_name', $shop->province_name);
        View::share('site_postal_code', $shop->postal_code);
        View::share('site_full_address', $shop->address.", ".$shop->subdistrict.", ".$shop->city_name.", ".$shop->province_name." ".$shop->postal_code);
    }
}
