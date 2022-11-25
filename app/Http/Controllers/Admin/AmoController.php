<?php

namespace App\Http\Controllers\Admin;

use AmoCRM\OAuth2\Client\Provider\AmoCRM;
use App\Classes\Site\Amo\AccessTokenMemento;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use League\OAuth2\Client\Grant\AuthorizationCode;


class AmoController extends Controller
{
    public function index()
    {
        return view('admin.amo.index');
    }

    public function authForm()
    {
        $clientSecret = '';
        $memento = AccessTokenMemento::getInstance();
        if ($memento->exists()) {
            $memento->load();
            $clientSecret = $memento->getClientSecret();
        }
        return view('admin.amo.auth_form')
            ->with('clientSecret', $clientSecret)
            ->with('clientId', config('amo.client_id'));
    }

    public function authSave(Request $request): RedirectResponse
    {
        $clientSecret = $request->input('client_secret');
        $amoCrm = new AmoCRM([
                                 'baseDomain' => config('amo.account_base_domain'),
                                 'clientId' => config('amo.client_id'),
                                 'redirectUri' => config('amo.redirect_uri'),
                                 'clientSecret' => $clientSecret,
                             ]);
        $token = $amoCrm->getAccessToken(
            new AuthorizationCode(),
            ['code' => $request->input('authorization_code')]
        );
        AccessTokenMemento::getInstance()
            ->setClientSecret($clientSecret)
            ->setAccessToken($token->getToken())
            ->setRefreshToken($token->getRefreshToken())
            ->setExpires($token->getExpires())
            ->save();
        return response()->redirectToRoute('admin.amo.index');
    }
}
