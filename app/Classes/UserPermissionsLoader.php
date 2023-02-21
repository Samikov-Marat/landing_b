<?php

namespace App\Classes;

use Illuminate\Support\Facades\Auth;

class UserPermissionsLoader
{
    public static function load($user)
    {
        Auth::user()->permissions = UserRepository::getAllPermissions($user);
        Auth::user()->load('franchisees');
    }
}
