<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\App;

class DebugbarDisable
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
        $providers = App::getProviders('Barryvdh\Debugbar\ServiceProvider');
        if(!empty($providers)){
            debugbar()->disable();
        }
        return $next($request);
    }
}
