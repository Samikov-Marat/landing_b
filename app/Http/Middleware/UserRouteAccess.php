<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class UserRouteAccess
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
        $routeName = Route::current()->getName();
        if (Gate::denies($routeName)) {
//            return abort(403, 'У вас недостаточно прав для посещения этой страницы');
        }
        return $next($request);
    }
}
