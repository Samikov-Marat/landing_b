<?php

namespace App\Http\Middleware;


use App\Classes\Site\ReferralCookiesHelper;
use Closure;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Classes\Domain;
use App\Classes\UtmSiteRepository;

class SaveUtmToCookies
{

    const VERSION = 2;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isMethod('GET')) {
            return $next($request);
        }

        $domain = Domain::getInstance($request);
        try {
            $site = new UtmSiteRepository($domain->get());
        } catch (ModelNotFoundException $exception) {
            return $next($request);
        }

        if ($domain->hasSubdomain()) {
            ReferralCookiesHelper::saveSubdomain(self::VERSION, $request, $domain);
            return $next($request);
        }

        $utmTags = $request->only($site->getTags());
        if (empty($utmTags)) {
            return $next($request);
        }
        ReferralCookiesHelper::saveUtm(self::VERSION, $request, $utmTags);
        return $next($request);
    }
}
