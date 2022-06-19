<?php

namespace App\Console\Commands\Domain;

use Illuminate\Database\Console\Migrations\BaseCommand;
use Illuminate\Support\Str;

class Migration extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'domain:new:migration {domain} {name : The name of the migration}
    {--create= : The table to be created}
    {--table= : The table to migrate}
    {--path= : The location where the migration file should be created}
    {--fullpath : Output the full path of the migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file under domain';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $domain = $this->argument('domain');

        $name = Str::snake(trim($this->argument('name')));
        $table = $this->option('table') ?: false;
        $create = $this->option('create') ?: false;
        $fullpath = $this->option('fullpath') ?: false;
        $path = $this->option('path') ?: false;

        $name = Str::snake(trim($this->input->getArgument('name')));

        $options = ['name' => $name];
        $options['--path'] = $path ? $path : "app/Domains/$domain/database/migrations";
        if ($table) {
            $options['--table'] = $table;
        }
        if ($create) {
            $options['--create'] = $create;
        }
        if ($fullpath) {
            $options['--fullpath'] = $fullpath;
        }

        $this->call('make:migration', $options);

        return 1;
    }

}
