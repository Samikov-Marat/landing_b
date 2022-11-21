<?php

namespace App\Classes\Site;

use App\Classes\Domain;
use App\Classes\UtmCookie;
use App\Classes\UtmSiteRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;

class ReferralCookiesHelper
{
    const VERSION = 2;

    private $forceSave;

    public function __construct()
    {
        $this->forceSave = false;
    }

    public static function getInstance(): self
    {
        return new static();
    }

    public function setForce(bool $forceSave): self
    {
        $this->forceSave = $forceSave;
        return $this;
    }

    public function save(Request $request): void
    {
        $domain = Domain::getInstance($request);
        try {
            $site = new UtmSiteRepository($domain->get());
        } catch (ModelNotFoundException $exception) {
            return;
        }

        if ($domain->hasSubdomain()) {
            $this->saveSubdomain($request, $domain);
            return;
        }

        $utmTags = $request->only($site->getTags());
        if (empty($utmTags)) {
            return;
        }
        $this->saveUtm($request, $utmTags);
    }


    public function saveSubdomain(Request $request, Domain $domain)
    {
        if (!$this->forceSave && !AllowCookie::getInstance($request)->isAllow()) {
            return;
        }
        $cookieParameter = ['subdomain' => $domain->getSubdomain()];
        $subdomainCookie = UtmCookie::getInstance()
            ->setVersion(static::VERSION)
            ->setData($cookieParameter);
        Cookie::queue(
            UtmCookie::COOKIE_NAME,
            $subdomainCookie->getAsJson(),
            UtmCookie::SUBDOMAIN_COOKIE_LIFETIME_MINUTES,
            '/',
            $domain->getCookieDomain()
        );
    }

    public function saveUtm(Request $request, array $utmTags)
    {
        if (!$this->forceSave && !AllowCookie::getInstance($request)->isAllow()) {
            return;
        }
        $utmCookie = UtmCookie::getInstance()
            ->setVersion(static::VERSION)
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
        if ($needSave) {
            Cookie::queue(
                UtmCookie::COOKIE_NAME,
                $utmCookie->getAsJson(),
                UtmCookie::UTM_COOKIE_LIFETIME_MINUTES
            );
        }
    }
}
