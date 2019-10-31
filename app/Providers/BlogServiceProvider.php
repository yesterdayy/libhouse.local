<?php

namespace App\Providers;

use App\Models\Menu\Menu;
use App\Models\Common\Settings;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->share('settings', Settings::instance());
        $GLOBALS['menu'] = Menu::instance();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
