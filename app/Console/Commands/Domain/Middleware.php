<?php

namespace App\Console\Commands\Domain;

use Illuminate\Console\Command;

class Middleware extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:new:middleware {domain} {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Middleware class under Domain';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $domain = $this->argument('domain');
        $name = $this->argument('name');

        $dPath = app_path("Domains/$domain");

        if (is_dir($dPath)) {
            $this->call('make:middleware', [
                'name' => "/App/Domains/$domain/Http/Middleware/$name",
            ]);

            $this->info("Middleware [$name] for Domain [$domain] has been created");

        } else {
            $this->error("Domain [$domain] does not exist");
        }

        return 0;
    }
}
