<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class Antifraud
{
    public function handle(Request $request, Closure $next)
    {
        $result = $next($request);
        if(!Cookie::has('antifraud')){
            Cookie::queue('antifraud', 1, strtotime('+1 month'), '/');
        }
        return $result;
    }
}
