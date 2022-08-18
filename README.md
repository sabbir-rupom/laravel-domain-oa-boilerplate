<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-v8-f05340.svg" alt="Laravel Version"></a>
<a href="https://github.com/sabbir-rupom/laravel-domain-oa-boilerplate/blob/main/composer.json"><img src="https://img.shields.io/badge/php-%3E%3D%207.3-8892BF.svg" alt="PHP Badge"></a>
<a href="https://github.com/sabbir-rupom/laravel-domain-oa-boilerplate/blob/main/LICENSE"><img src="https://img.shields.io/badge/License-MIT-yellow.svg" alt="License"></a>
</p>

# Laravel Domain Oriented Architecture Boilerplate

Laravel boilerplate for building Domain Oriented Architecture based web application. (Current: Laravel 8.\*)

## Installation
- Clone the git repository `git clone https://github.com/sabbir-rupom/laravel-domain-oa-boilerplate.git`
- Install & Update libraries with `composer update`
- Rename and set your Server Configuration in `.env`.
- Excecute following commands: 
    - `php artisan key:generate`
    - `php artisan cache:clear`
    - `php artisan optimize`
    - [Optional] `php artisan migrate:refresh --seed`  

**NOTE**: `.../project-root/app/Core/*` holds the *Domain Mechanism* of this project.  

## Create New Domain

* Enter command to create new Domain space: `php artisan domain:new DomainName`
    * For REST-API, you can hit command like: `php artisan domain:new YourDomain --api`

On successful command run, a new domain[YourDomain] will be created under `project-root/app/Domains`. 

**Initial Folder Structure of a Domain**
<p><img src="https://raw.githubusercontent.com/sabbir-rupom/laravel-domain-oa-boilerplate/main/public/capture.png"></p> 

## Development Guide

* Create new controller: `php artisan domain:new:controller DomainName ControllerName`

* Create new request: `php artisan domain:new:request DomainName RequestName`

* Create new middleware: `php artisan domain:new:middleware DomainName MiddlewareName`

* Create new model: `php artisan domain:new:model DomainName ModelName`
    * If you wish to create a create-table-migration file as well: `php artisan domain:new:model DomainName ModelName --m`

* Create new migration: `php artisan domain:new:migration DomainName name_table_migration`
    * You can use the options like `--create` , `--table` , `--path` command options like the existing `make:migration` command structure

* Create new seeder: `php artisan domain:new:seeder DomainName SeederName`

Domain core service will automatically detect all the domain changes and will initialize each domain routes, migrations, seeders etc. during application run.

**NOTE**: Do not forget to clear cache and optimize routes if any new major changes occured inside Domains.

### Domain Configuration

Configuration parameter of each Domain should be defined in `app\Domains\DomainName\config\domain.php`
You can retrieve enabled domain information through `\Illuminate\Support\Facades\Cache::get('app_domains')`

### CSS / JS compile with Laravel mix

CSS and Javascript files under resources folder in `Domains` will be compiled automatically with laravel-mix webpack command 

**NOTE**: Do not change the `webpack.mix.js` file arbitrarily, the default mix configuration may hamper the auto domain-resource compilation process.

### Example

* Check the branch [Example - 1](https://github.com/sabbir-rupom/laravel-domain-oa-boilerplate/tree/example-1.0) for study.


If you liked this project, don't forget to give a star rating to this project repository. :smile:
## License

This project is licensed under the [MIT License](LICENSE).
