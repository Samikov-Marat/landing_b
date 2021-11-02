<?php

namespace App\Http\Middleware;

use App\Classes\Site\AllowCookie;
use Closure;
use Exception;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Classes\Domain;
use App\Classes\UtmCookie;
use App\Classes\UtmSiteRepository;
use Illuminate\Support\Facades\Log;

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
        $domain = Domain::getInstance($request)->get();
        try {
            $site = new UtmSiteRepository($domain);
        } catch (ModelNotFoundException $exception) {
            return $next($request);
        }
        $utmTags = $request->only($site->getTags());
        if (empty($utmTags)) {
            return $next($request);
        }
        $utmCookie = UtmCookie::getInstance()
            ->setVersion(self::VERSION)
            ->setData($utmTags);

        $old = Cookie::get(UtmCookie::COOKIE_NAME);
        $needSave = true;
        if (!is_null($old)) {
            try {
                $oldUtmCookie = UtmCookie::getInstanceFromJson($old);
                $needSave = $oldUtmCookie->isOlderThanVersion($utmCookie->getVersion());
            } catch (Exception $e) {
                Log::error('Неверный формат сохранённого utm. Данные будут перезаписаны.');
            }
        }
        if ($needSave && AllowCookie::getInstance($request)->isAllow()) {
            Cookie::queue(
                UtmCookie::COOKIE_NAME,
                $utmCookie->getAsJson(),
                UtmCookie::COOKIE_LIFETIME_MINUTES
            );
        }
        return $next($request);
    }
}
