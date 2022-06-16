<?php

namespace App\Console\Commands\Domain;

use Illuminate\Console\GeneratorCommand;

class Seeder extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:new:seeder {domain} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new seeder class under domain';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Seeder';

    protected $domain;
    protected $databasePath;
    protected $className;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->domain = $this->argument('domain');
        $this->name = $this->argument('name');

        $dPath = app_path("Domains/{$this->domain}");

        if (is_dir($dPath)) {
            $this->databasePath = "$dPath/database";

            parent::handle();

            $this->info("Seeder [{$this->name}] for Domain [{$this->domain}] has been created");

        } else {
            $this->error("Domain [{$this->domain}] does not exist");
        }

        return 0;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/seeder.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return $this->laravel->basePath(
            'vendor/laravel/framework/src/Illuminate/Database/Console/Seeds/'
            . trim($stub, '/')
        );
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        return $this->databasePath . '/seeders/' . $this->name . '.php';
    }
    
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return 'App\Domains\\'.$this->domain.'\Database\Seeders';
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $searches = [
            ['Database\Seeders', '{{ rootNamespace }}', 'NamespacedDummyUserModel'],
        ];

        foreach ($searches as $search) {
            $stub = str_replace(
                $search,
                [$this->getNamespace($name), $this->rootNamespace(), $this->userProviderModel()],
                $stub
            );
        }

        return $this;
    }
}
