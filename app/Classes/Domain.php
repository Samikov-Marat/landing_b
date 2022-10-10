<?php

namespace App\Classes;


use App\Alias;
use App\Exceptions\AliasNeedAuthentication;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class Domain
{
    var $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function getInstance(Request $request)
    {
        return new static($request);
    }

    public function get()
    {
        $domain = $this->request->server('HTTP_HOST');

        try {
            $alias = $this->getAlias($domain);
            $this->checkAliasAccess($alias);
            return $alias->site->domain;
        } catch (ModelNotFoundException $e) {
            return $domain;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            abort(Response::HTTP_NOT_FOUND);
        }
    }

    private function getAlias($domain)
    {
        $alias = Alias::where('domain', $domain)
            ->with('site')
            ->firstOrFail();
        if (!$alias->site->count()) {
            throw new Exception('Не найден сайт');
        }
        return $alias;
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
}
