<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;

class Antifraud
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $result = $next($request);
        if(!Cookie::has('antifraud')){
            Cookie::queue('antifraud', 1, strtotime('+1 month'), '/');
        }
        return $result;
    }
}
