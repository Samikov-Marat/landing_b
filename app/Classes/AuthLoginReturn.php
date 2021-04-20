<?php

namespace App\Classes;

use Illuminate\Support\Facades\Session;

class AuthLoginReturn
{
    const KEY = 'auth_login_return_path';

    public static function set($path)
    {
        Session::put(self::KEY, $path);
    }

    public static function exists(): bool
    {
        return Session::has(self::KEY);
    }

    public static function getAndClear()
    {
        return Session::pull(self::KEY);
    }
}
