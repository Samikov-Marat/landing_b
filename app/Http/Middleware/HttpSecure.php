<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class HttpSecure
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
//        if (App::environment('production') && !$request->isSecure()) {
//            return redirect()->secure($request->getRequestUri());
//        }
        return $next($request);
    }
}