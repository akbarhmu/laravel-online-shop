<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
    }
}
