<?php

namespace App\Domains\Core\Services;

use Illuminate\Support\Facades\Cache;

class Bootstrap
{
    protected $domains;
    protected $path;
    protected $keys;
    protected $templates;

    public function initDomains()
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
                $this->domains[] = [
                    'config' => $config,
                    'path' => $path,
                    'name' => $domainName,
                    'base' => strtolower(preg_replace('/(.)([A-Z])/', '$1_$2', $domainName)),
                ];
            }

            Cache::put('app_domains', $this->domains, 300);
        }

    }

    public function initViews()
    {
        if ($this->domains) {
            foreach ($this->domains as $d) {
                view()->addNamespace("{$d['base']}_view", $d['path'] . "/resources/views");
            }
        }
    }

    public static function init()
    {
        $run = new Self();
        $run->path = app_path('Domains');

        $run->initDomains();
        $run->initViews();
        
        return $run->domains;
    }
}
