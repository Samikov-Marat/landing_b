<?php

namespace App\Classes;

use Exception;
use Illuminate\Support\Facades\Session;

class AuthLoginReturn
{
    const KEY = 'auth_login_return_path';

    public static function set($path)
    {
        Session::put(static::KEY, $path);
    }

    public static function get(): string
    {
        if (static::notExists()) {
            throw new Exception('Не задан адрес псевдонима');
        }
        return Session::get(static::KEY);
    }

    public static function getAndClear(): string
    {
        if (static::notExists()) {
            throw new Exception('Не задан адрес псевдонима');
        }
        return Session::pull(static::KEY);
    }


    public static function notExists(): bool
    {
        return !static::exists();
    }

    public static function exists(): bool
    {
        return Session::has(static::KEY);
    }


}
