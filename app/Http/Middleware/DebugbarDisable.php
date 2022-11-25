<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class DebugbarDisable
{
    public function handle(Request $request, Closure $next)
    {
        $providers = App::getProviders('Barryvdh\Debugbar\ServiceProvider');
        if (!empty($providers)) {
            debugbar()->disable();
        }
        return $next($request);
    }
}
