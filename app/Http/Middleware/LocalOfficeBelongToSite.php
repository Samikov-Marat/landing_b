<?php

namespace App\Http\Middleware;

use App\Site;
use Closure;

class LocalOfficeBelongToSite
{
    public function handle($request, Closure $next)
    {
        $requestParams = $request->route()->parameters();
        $site = $requestParams['site'];
        $localOffice = $requestParams['localOffice'];

        if ($localOffice->site_id !== $site->id) {
            return response()->redirectToRoute('admin.local_offices.index', ['site' => $site]);
        }
        return $next($request);
    }
}
