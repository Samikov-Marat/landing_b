<?php

namespace App\Classes\Site;

use App\Classes\Domain;
use App\Classes\UtmCookie;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;

class ReferralCookiesHelper
{
    public static function saveSubdomain(int $version, Request $request, Domain $domain)
    {
        $cookieParameter = ['subdomain' => $domain->getSubdomain()];
        $subdomainCookie = UtmCookie::getInstance()
            ->setVersion($version)
            ->setData($cookieParameter);
        if (AllowCookie::getInstance($request)->isAllow()) {
            Cookie::queue(
                UtmCookie::COOKIE_NAME,
                $subdomainCookie->getAsJson(),
                UtmCookie::SUBDOMAIN_COOKIE_LIFETIME_MINUTES,
                '/',
                $domain->getCookieDomain()
            );
        }
    }

    public static function saveUtm(int $version, Request $request, array $utmTags)
    {
        $utmCookie = UtmCookie::getInstance()
            ->setVersion($version)
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
                UtmCookie::UTM_COOKIE_LIFETIME_MINUTES
            );
        }
    }
}
