<?php

namespace App\Domains\Core\Services;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Cache;

class Bootstrap
{
    protected $domains;
    protected $path;
    private $kernel;

    public function __construct()
    {
        $this->domains = [];
    }

    /**
     * Init domain bootstrap methods
     *
     * @return Bootstrap
     */
    public function init(): Bootstrap
    {
        $this->kernel = app(Kernel::class);

        if ($this->domains) {
            foreach ($this->domains as $d) {
                $this->setViews($d);
                $this->setMiddlewares($d['config']);
            }
        }

        return $this;
    }

    public function registerServices()
    {
        // foreach ($this->domains as $d) {

        //     $domainProviderClass = '\App\Domains\\' . $d['name'] . '\\Providers\\DomainServiceProvider';
        //     if (class_exists($domainProviderClass)) {
        //         dd('1111');
        //     }
        // }
    }

    public function get(): array
    {
        return $this->domains;
    }

    /**
     * Find and cache all active domains
     *
     * @return Bootstrap
     */
    public static function domains():Bootstrap
    {
        $app = new Self();
        $app->path = app_path('Domains');
        $app->domains = Cache::get('app_domains');

        if (empty($app->domains)) {
            $app->domains = [];
            foreach (array_filter(glob($app->path . '/*', GLOB_ONLYDIR)) as $path) {
                if (!is_file($path . '/config/domain.php')) {
                    continue;
                }
                $config = include $path . '/config/domain.php';

                $domainName = basename($path);

                if (isset($config['enable']) && !$config['enable'] && strtolower($domainName) !== 'core') {
                    continue;
                }

                $app->domains[] = [
                    'config' => $config,
                    'path' => $path,
                    'name' => $domainName,
                    'base' => strtolower(preg_replace('/(.)([A-Z])/', '$1_$2', $domainName)),
                ];
            }

            Cache::put('app_domains', $app->domains, 300);
        }

        return $app;

    }

    /**
     * Register view paths for domain views 
     *
     * @param array $domain Active domain array
     * @return Bootstrap
     */
    public function setViews(array $domain): Bootstrap
    {
        view()->addNamespace("{$domain['base']}_view", $domain['path'] . "/resources/views");

        return $this;
    }

    /**
     * Register middlewares from domain configuration settings
     *
     * @param array $config
     * @return Bootstrap
     */
    public function setMiddlewares(array $config):Bootstrap
    {
        if (isset($config['middleware']) && !empty($config['middleware'])) {
            foreach ($config['middleware'] as $middleware) {
                $this->kernel->pushMiddleware($middleware);
            }
        }

        if (isset($config['middleware-group']) && !empty($config['middleware-group'])) {
            foreach ($config['middleware-group'] as $group => $middleware) {
                $this->kernel->appendMiddlewareToGroup($group, $middleware);
            }
        }

        return $this;
    }
}
