<?php

namespace App\Classes;


use App\Alias;
use App\Exceptions\AliasNeedAuthentication;
use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class Domain
{
    private $request;

    private $subdomain;

    private $originalDomain;

    private $cookieDomain = '';

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->originalDomain = $this->request->server('HTTP_HOST');
        $this->cookieDomain = $this->originalDomain;
        $this->subdomain = '';
    }

    public static function getInstance(Request $request): self
    {
        return new static($request);
    }

    public function get(): string
    {
        try {
            try {
                $alias = $this->getAlias($this->originalDomain);
                $this->checkAliasAccess($alias);
                return $alias->site->domain;
            } catch (ModelNotFoundException $e) {
            }

            try {
                $site = Site::where('domain', $this->originalDomain)->firstOrFail();
                return $site->domain;
            } catch (ModelNotFoundException $e) {
            }

            try {
                $baseDomain = $this->reduce($this->originalDomain);
                $alias = $this->getAlias($baseDomain);
                $this->checkAliasAccess($alias);
                $this->cookieDomain = $baseDomain;
                $this->makeSubdomain();
                return $alias->site->domain;
            } catch (ModelNotFoundException $e) {
            }

            try {
                $baseDomain = $this->reduce($this->originalDomain);
                $site = Site::where('domain', $baseDomain)->firstOrFail();
                $this->cookieDomain = $baseDomain;
                $this->makeSubdomain();
                return $site->domain;
            } catch (ModelNotFoundException $e) {
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
            abort(Response::HTTP_NOT_FOUND);
        }
        return $this->originalDomain;
    }

    private function getAlias($domain)
    {
        $alias = Alias::where('domain', $domain)
            ->has('site')
            ->with('site')
            ->firstOrFail();
        return $alias;
    }

    private function reduce(string $domain): string
    {
        return Str::after($domain, '.');
    }

    private function makeSubdomain()
    {
        $this->subdomain = Str::before($this->originalDomain, '.');
    }

    public function getSubdomain(): string
    {
        return $this->subdomain;
    }

    public function hasSubdomain(): bool
    {
        return $this->subdomain !== '';
    }

    /**
     * Домены 4 уровня для тестовых версий сайтов оказались без https.
     * Поэтому сделана вторизация по cookies для запрета доступа поисковикам.
     * @throws AliasNeedAuthentication
     */
    private function checkAliasAccess(Alias $alias)
    {
        if ($alias->public) {
            return;
        }

        if (Auth::guest() &&
            !$this->request->hasCookie(AliasHttpCookie::NAME)) {
            throw new AliasNeedAuthentication(
                'Страница только для авторизованных пользователей',
                $this->request->fullUrl()
            );
        }
    }

    public function getCookieDomain(){
        return $this->cookieDomain;
    }
}
