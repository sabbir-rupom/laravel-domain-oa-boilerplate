<?php

namespace App\Console\Commands\Domain;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Model extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:new:model {domain} {model} {--m}';

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
        $name = $this->argument('model');

        $dPath = app_path("Domains/$domain");

        if (is_dir($dPath)) {
            $this->call('make:model', [
                'name' => "/App/Domains/$domain/Models/$name",
            ]);

            if ($this->option('m')) {
                $table = Str::snake(Str::pluralStudly(class_basename($name)));

                $this->call('make:migration', [
                    'name' => "create_{$table}_table",
                    '--create' => $table,
                    '--path' => "app/Domains/$domain/database/migrations",
                ]);
            }

            $this->info("Model [$name] for Domain [$domain] has been created");

        } else {
            $this->error("Domain [$domain] does not exist");
        }

        return 1;
    }
}
