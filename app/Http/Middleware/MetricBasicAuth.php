<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MetricBasicAuth
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
        if (
            ($request->getUser() === config('app.metric_basic_auth.user'))
            && ($request->getPassword() === config('app.metric_basic_auth.password'))
        ) {
            return $next($request);
        }
        return response()->noContent()->setStatusCode(Response::HTTP_FORBIDDEN);
    }
}
