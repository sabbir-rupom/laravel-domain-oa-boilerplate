<?php

namespace App\Console\Commands\Domain;

use Illuminate\Console\Command;

class Controller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:new:controller {domain} {controller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        $domain = $this->argument('domain');
        $name = $this->argument('controller');

        $dPath = app_path("Domains/$domain");

        if(is_dir($dPath)) {
            $this->call('make:controller', [
                'name' => "/App/Domains/$domain/Http/Controllers/$name"
            ]);

            $this->info("Controller [$name] for Domain [$domain] has been created");
        } else {
            $this->error("Domain [$domain] does not exist");
        }

        return 0;
    }
}
