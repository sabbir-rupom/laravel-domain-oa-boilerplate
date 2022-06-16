<?php

namespace Database\Seeders;

use App\Domains\Core\Services\Bootstrap;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // \App\Models\User::factory(10)->create();

        $this->scanDomainSeeders();

    }

    /**
     * Scan seeder classes from Domains
     *
     * @return void
     */
    protected function scanDomainSeeders()
    {
        $domains = Bootstrap::init();

        $this->command->info(PHP_EOL . 'Scanning for domain seeders: ');

        if (is_array($domains) && count($domains) > 0) {
            foreach ($domains as $d) {
                if (is_dir($d['path'] . "/database/seeders/")) {

                    $this->findThenCallSeeders($d['path'] . "/database/seeders/", $this->getNamespace($d['name']));

                }
            }
        }

        $this->command->info('Scan completed' . PHP_EOL);
    }

    /**
     * Call and execute seeder classes in Domains
     *
     * @param string $path Domain path
     * @param string $namespace Seeder class namespace
     * @return void
     */
    protected function findThenCallSeeders(string $path, string $namespace)
    {
        $seedFilePattern = '/([a-zA-Z0-9_\-]+)\.php/i';

        foreach (scandir($path) as $file) {
            if (!in_array($file, ['.', '..', 'DatabaseSeeder.php'])) {
                if (preg_match($seedFilePattern, $file, $matches)) {
                    $class = ("$namespace\\{$matches[1]}");
                    if (isset($matches[1]) && class_exists($class)) {
                        $this->call($class);
                    }
                } else {
                    echo '[WARNING] The file "' . $file . '" does not match the seeding pattern "' . $seedFilePattern . '", rename it accordingly to seed it automagically' . PHP_EOL;
                }
            }
        }
    }

    /**
     * Fetch namespace of Seeder class under the Domain
     *
     * @param string $domain Domain name
     * @return string
     */
    protected function getNamespace(string $domain): string
    {
        return 'App\Domains\\' . $domain . '\Database\Seeders';
    }

}
