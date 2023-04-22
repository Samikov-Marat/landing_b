<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class HttpSecure
{
    public function handle(Request $request, Closure $next)
    {
        if (('on' == $request->server('HTTPS', 'off')) && !$request->isSecure()) {
            Log::error('Подключение не защищено. Возможно, устарел адрес балансировщика в файле config/trustedproxy.php', $request->server());
            abort(
                HttpFoundationResponse::HTTP_FORBIDDEN,
                'Подключение не защищено. Возможно, устарел адрес балансировщика в файле config/trustedproxy.php'
            );
        }
        if (!$request->isSecure()) {
            return redirect()->secure($request->getRequestUri());
        }
        return $next($request);
    }
}
