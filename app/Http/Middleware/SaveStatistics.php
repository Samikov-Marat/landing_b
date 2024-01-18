<?php

namespace App\Http\Middleware;

use App\Classes\Site\StatisticsRedis;
use App\Statistics;
use Closure;
use Illuminate\Http\Request;

class SaveStatistics
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        $statistics = new Statistics();
        $statistics->full_url = $request->fullUrl();
        $statistics->site = $request->server('HTTP_HOST');
        $statistics->page = $request->path();
        $statistics->utm_source = $request->input('utm_source');
        $statistics->utm_medium = $request->input('utm_medium');
        $statistics->utm_campaign = $request->input('utm_campaign');
        $statistics->utm_term = $request->input('utm_term');
        $statistics->utm_content = $request->input('utm_content');

        $time = $statistics->freshTimestamp();
        $statistics->setUpdatedAt($time);
        $statistics->setCreatedAt($time);
        StatisticsRedis::save($statistics->toJson());

        return $next($request);
    }
}
