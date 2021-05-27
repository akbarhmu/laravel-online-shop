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
    }
}
