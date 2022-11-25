<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class UserRouteAccess
{
    public function handle($request, Closure $next)
    {
        $routeName = Route::current()->getName();
        if (Gate::denies($routeName)) {
            return abort(HttpFoundationResponse::HTTP_FORBIDDEN, 'У вас недостаточно прав для посещения этой страницы');
        }
        return $next($request);
    }
}
