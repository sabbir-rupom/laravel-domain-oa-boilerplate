<?php

namespace App\Domains\Core\Traits;

trait Singleton
{
    private static $obj;

    protected function __construct()
    {}

    public static function instance($data = null)
    {
        if (!self::$obj) {
            // new self() will refer to the class that uses the trait
            self::$obj = new self($data);
        }

        return self::$obj;
    }

    public function __clone()
    {}
    public function __sleep()
    {}
    public function __wakeup()
    {}
}
