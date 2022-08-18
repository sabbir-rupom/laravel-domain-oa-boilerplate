<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Console Commands
    |--------------------------------------------------------------------------
    |
    | This option allows you to add additional Artisan commands that should
    | be available within the Tinker environment. Once the command is in
    | this array you may execute the command in Tinker using its name.
    |
    */

    'commands' => [
        \App\Console\Commands\Domain\Create::class,
        \App\Console\Commands\Domain\Controller::class,
        \App\Console\Commands\Domain\Model::class,
        \App\Console\Commands\Domain\FormRequest::class,
        \App\Console\Commands\Domain\Seeder::class,
        \App\Console\Commands\Domain\Middleware::class,
        \App\Console\Commands\Domain\Migration::class,
        \App\Console\Commands\RefreshCache::class,

    ],

    /*
    |--------------------------------------------------------------------------
    | Auto Aliased Classes
    |--------------------------------------------------------------------------
    |
    | Tinker will not automatically alias classes in your vendor namespaces
    | but you may explicitly allow a subset of classes to get aliased by
    | adding the names of each of those classes to the following list.
    |
    */

    'alias' => [
        //
    ],

    /*
    |--------------------------------------------------------------------------
    | Classes That Should Not Be Aliased
    |--------------------------------------------------------------------------
    |
    | Typically, Tinker automatically aliases classes as you require them in
    | Tinker. However, you may wish to never alias certain classes, which
    | you may accomplish by listing the classes in the following array.
    |
    */

    'dont_alias' => [
        'App\Nova',
    ],

];
