<?php

namespace App\Providers;

use App\Domains\Core\Services\Bootstrap;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/redirects';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            /**
             * Init domain configuration
             */
            $domains = Bootstrap::domains()->get();

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(function ($router) use ($domains) {
                    require base_path('routes/web.php');

                    // Include all web route files from domain
                    $this->includeRequired('web', $domains);
                });

            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(function ($router) use ($domains) {
                    require base_path('routes/api.php');

                    // Include all api route files from domain
                    $this->includeRequired('api', $domains);
                });
        });
    }

    /**
     * Include all required domain routes with necessary guard driver
     *
     * @param string $route
     * @param [type] $domains
     * @return void
     */
    protected function includeRequired(string $guard, $domains)
    {
        if (is_array($domains) && count($domains) > 0) {
            foreach ($domains as $d) {
                if (is_file($d['path'] . "/routes/{$guard}.php")) {
                    require $d['path'] . "/routes/{$guard}.php";

                    // echo  $d['path'] . "/routes/{$guard}.php" . PHP_EOL;
                }
            }
        }
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
