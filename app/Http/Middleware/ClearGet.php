<?php

namespace App\Http\Middleware;

use App\Classes\Site\RequestCleaner;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

class ClearGet
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod(Request::METHOD_GET)) {
            $clearedRequest = new RequestCleaner($request);
            if($clearedRequest->isChanged()){
                return redirect($request->url() . '?' . http_build_query($clearedRequest->getCleared()));
            }
        }
        return $next($request);
    }

}
