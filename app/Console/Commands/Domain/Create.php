<?php

namespace App\Console\Commands\Domain;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Create extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:new {domain}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Domain';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        try {
            $domain = $this->argument('domain');

            $domainsDir = $this->getDomainsDir();

            $this->makeNewDomainDir($domain, $domainsDir);

            $this->info("Domain [$domain] has been created");
            return 0;
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }
    }

    private function getAppDir(): string
    {
        for ($i = 1; $i <= 10; $i++) {
            $appDir = dirname(__DIR__, $i) . '/app';

            $appDirExists = file_exists($appDir);

            if ($appDirExists) {
                break;
            }
        }

        if (!$appDirExists) {
            throw new \Exception('Could not find app directory! Command must be with in subdirectory of app');
        }

        return $appDir;
    }

    private function getDomainsDir(): string
    {
        $appDir = $this->getAppDir();

        $domainDir = $appDir . '/Domains';
        $domainDirExists = file_exists($domainDir);

        if (!$domainDirExists) {
            mkdir($domainDir);
        }

        return $domainDir;
    }

    private function makeNewDomainDir(string $domain, string $domainsDir)
    {
        $newDomainDir = $domainsDir . '/' . $domain;
        $alreadyExists = file_exists($newDomainDir);

        if ($alreadyExists) {
            throw new \Exception($domain . ' domain already exists! Will not overwrite existing domain.');
        }

        mkdir($newDomainDir);

        $folders = [
            'Http/Controllers',
            'Http/Middleware',
            'Http/Requests',
            'Repositories',
            'Models',
            'routes',
            'config',
            'Exceptions',
            'Services',
            'resources/css',
            'resources/js',
            'resources/views',
            'database/migrations',
            'database/seeders',
        ];

        foreach ($folders as $folder) {
            $newFolder = $newDomainDir . '/' . $folder;
            mkdir($newFolder, 0777, true);
        }

        // Create domain configuration file
        $domainConfigFile = "$newDomainDir/config/domain.php";
        $fHandler = fopen($domainConfigFile, "w") or die("Unable to create domain config file!");
        fwrite($fHandler, "<?php\n\nreturn [\n];");
        fclose($fHandler);

        // Create route files
        foreach (['web', 'api'] as $v) {
            # code...
            $fHandler = fopen("$newDomainDir/routes/$v.php", "w") or die("Unable to create web route file!");
            fwrite($fHandler, "<?php\n\nuse Illuminate\Support\Facades\Route;");
            fclose($fHandler);
        }

        return true;
    }

}
