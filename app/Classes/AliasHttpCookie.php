<?php

namespace App\Classes;

class AliasHttpCookie
{
    var $cookie;
    const NAME = 'allow_test_access';
    const MINUTES = 60 * 24 * 365;

    public static function getInstance(): self
    {
        return new static();
    }

    public function __construct()
    {
        $this->cookie = cookie(
            static::NAME,
            1,
            static::MINUTES,
            '/',
            env('ALIAS_COOKIE_DOMAIN')
        );
    }

    public function get()
    {
        return $this->cookie;
    }
}
