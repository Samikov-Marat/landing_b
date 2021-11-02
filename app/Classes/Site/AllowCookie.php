<?php

namespace App\Classes\Site;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class AllowCookie
{
    const COOKIE_NAME = 'allow_cookies';
    private $value;

    public static function getInstance(Request $request): self
    {
        return new static($request);
    }

    public function __construct($request)
    {
        $this->value = $request->cookie(static::COOKIE_NAME);
    }

    public function isAllow(): bool
    {
        return isset($this->value);
    }

    public function setAllow()
    {
        Cookie::queue(static::COOKIE_NAME, 1, $this->getLifetime(), '/');
    }

    private function getlifetime()
    {
        return strtotime('+3 years');
    }
}
