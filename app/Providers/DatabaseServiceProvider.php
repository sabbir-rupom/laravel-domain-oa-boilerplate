<?php

namespace App\Providers;

use App\Domains\Core\Services\Bootstrap;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bootstrap::init();
        $domains = Cache::get('app_domains');

        if (is_array($domains) && count($domains) > 0) {
            foreach ($domains as $d) {
                if (is_dir($d['path'] . "/database/migrations/")) {
                    $this->loadMigrationsFrom($d['path'] . "/database/migrations/");
                }
            }
        }
    }
}
