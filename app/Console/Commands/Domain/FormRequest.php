<?php

namespace App\Console\Commands\Domain;

use Illuminate\Console\Command;

class FormRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:new:request {domain} {request}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Form-Request class under Domain';

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
        $name = $this->argument('request');

        $dPath = app_path("Domains/$domain");

        if (is_dir($dPath)) {
            $this->call('make:request', [
                'name' => "/App/Domains/$domain/Http/Requests/$name",
            ]);

            $this->info("Request [$name] for Domain [$domain] has been created");

        } else {
            $this->error("Domain [$domain] does not exist");
        }

        return 1;
    }
}
