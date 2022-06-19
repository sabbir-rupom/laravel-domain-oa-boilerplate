<?php

namespace App\Providers;

use App\Domains\Core\Services\Bootstrap;
use Illuminate\Pagination\Paginator;
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bootstrap::domains()->init();

        Paginator::useBootstrap();
    }
}
