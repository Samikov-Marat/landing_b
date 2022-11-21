<?php

namespace App\Http\Middleware;


use App\Classes\Site\ReferralCookiesHelper;
use Closure;

class SaveUtmToCookies
{


    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        ReferralCookiesHelper::getInstance()->save($request);
        return $next($request);
    }
}
