<?php

namespace App\Http\Middleware;

use App\Statistics;
use Closure;

class SaveStatistics
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
        $statistics = new Statistics();
        $statistics->site = $request->server('HTTP_HOST');
        $statistics->page = $request->path();
        $statistics->utm_source = $request->input('utm_source');
        $statistics->utm_medium = $request->input('utm_medium');
        $statistics->utm_campaign = $request->input('utm_campaign');
        $statistics->utm_term = $request->input('utm_term');
        $statistics->utm_content = $request->input('utm_content');
        $statistics->save();

        return $next($request);
    }
}
