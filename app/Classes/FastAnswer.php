<?php

namespace App\Classes;

use App\Classes\Site\AllowCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class FastAnswer
{
    public static function setShowFastAnswer (Request $request, string $pageUrl): bool
    {
        if (!AllowCookie::getInstance($request)->isAllow()) {
            return true;
        }

        if ($pageUrl == 'contacts') {
            Cookie::queue('fastAnswer', true);
            return false;
        }

        return !$request->cookie('fastAnswer', false);
    }
}
