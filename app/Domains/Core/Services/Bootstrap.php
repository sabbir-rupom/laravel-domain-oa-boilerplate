<?php

namespace App\Domains\Core\Services;

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\Facades\Cache;

class Bootstrap
{
    protected $domains;
    protected $path;
    private $kernel;

    public static function init()
    {
        $app = new Self();
        $app->path = app_path('Domains');
        $app->kernel = app(Kernel::class);

        $app->findDomains()->run();
        return $app->domains;
    }

    public function findDomains()
    {
        $this->domains = Cache::get('app_domains');

        if (empty($this->domains)) {
            $this->domains = [];
            foreach (array_filter(glob($this->path . '/*', GLOB_ONLYDIR)) as $path) {
                if (!is_file($path . '/config/domain.php')) {
                    continue;
                }
                $config = include $path . '/config/domain.php';

                $domainName = basename($path);

                if (isset($config['enable']) && !$config['enable'] && strtolower($domainName) !== 'core') {
                    continue;
                }

                $this->domains[] = [
                    'config' => $config,
                    'path' => $path,
                    'name' => $domainName,
                    'base' => strtolower(preg_replace('/(.)([A-Z])/', '$1_$2', $domainName)),
                ];
            }

            Cache::put('app_domains', $this->domains, 300);
        }

        return $this;

    }

    public function run() {

        if ($this->domains) {
            foreach ($this->domains as $d) {
                $this->setViews($d);
                $this->setMiddlewares($d['config']);
            }
        }

    }

    public function setViews(array $domain)
    {
        view()->addNamespace("{$domain['base']}_view", $domain['path'] . "/resources/views");
    }

    public function setMiddlewares(array $config)
    {
        if(isset($config['middleware']) && !empty($config['middleware'])) {
            foreach ($config['middleware'] as $middleware) {
                $this->kernel->pushMiddleware($middleware);
            }
        }

        if(isset($config['middleware-group']) && !empty($config['middleware-group'])) {
            foreach ($config['middleware-group'] as $group => $middleware) {
                $this->kernel->appendMiddlewareToGroup($group, $middleware);
            }
        }

        return $this;
    }
}
