<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;

class HttpSecure
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
        if (('on' == $request->server('HTTPS', 'off')) && !$request->isSecure()) {
            abort(
                Response::HTTP_FORBIDDEN,
                'Подключение не защищено. Возможно, устарел адрес балансировщика в файле config/trustedproxy.php'
            );
        }
        if (!$request->isSecure()) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
