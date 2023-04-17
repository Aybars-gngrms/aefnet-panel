<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SiteSettings;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->share('config',SiteSettings::find(1));
    }
}
