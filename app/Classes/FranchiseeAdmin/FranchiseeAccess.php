<?php

namespace App\Classes\FranchiseeAdmin;

use App\Site;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class FranchiseeAccess
{
    public function __construct()
    {
        if (Gate::denies('is_franchisee')) {
            abort(HttpFoundationResponse::HTTP_FORBIDDEN, 'У вас недостаточно прав для посещения этой страницы');
        }
    }

    // Упрощённая схема с одним франчайзи на пользователя
    public function getFranchisee()
    {
        return auth()->user()->franchisees->first();
    }

    public function checkAllow($franchisee): void
    {
        if (Gate::denies('franchisee', $franchisee)) {
            abort(HttpFoundationResponse::HTTP_FORBIDDEN, 'У вас недостаточно прав для посещения этой страницы');
        }
    }

    public function checkSite(Site $site): void
    {
        $site->load('localOffices.franchisee');
        $franchisees = $site->localOffices->pluck('franchisee')
            ->unique();

        foreach ($franchisees as $franchisee) {
            if (Gate::allows('franchisee', $franchisee)) {
                return;
            }
        }
        abort(HttpFoundationResponse::HTTP_FORBIDDEN, 'У вас недостаточно прав для посещения этой страницы');
    }
}
