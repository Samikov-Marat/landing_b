<?php

namespace App\Http\Middleware;


use App\Classes\Site\ReferralCookiesHelper;
use Closure;
use Illuminate\Http\Request;

class SaveUtmToCookies
{


    public function handle(Request $request, Closure $next)
    {
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        ReferralCookiesHelper::getInstance()->save($request);
        return $next($request);
    }
}
