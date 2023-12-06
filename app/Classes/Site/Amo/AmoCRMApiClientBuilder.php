<?php

namespace App\Classes\Site\Amo;

use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

class AmoCRMApiClientBuilder
{
    public static function getInstance(): self
    {
        return new static();
    }

    public function getClient(): AmoCRMApiClient
    {
        $memento = new AccessTokenMemento(config('amo.oauth_tmp_file'));
        $memento->load();
        $token = new AccessToken([
                                     'access_token' => $memento->getAccessToken(),
                                     'refresh_token' => $memento->getRefreshToken(),
                                     'expires' => $memento->getExpires(),
                                     'baseDomain' => config('amo.account_base_domain'),
                                 ]);
        $apiClient = new AmoCRMApiClient(
            config('amo.client_id'),
            $memento->getClientSecret(),
            config('amo.redirect_uri')
        );
        $apiClient->setAccessToken($token)
            ->setAccountBaseDomain(config('amo.account_base_domain'))
            ->onAccessTokenRefresh(
                function (AccessTokenInterface $accessToken, string $baseDomain) use ($memento) {
                    $memento->setAccessToken($accessToken->getToken())
                        ->setRefreshToken($accessToken->getRefreshToken())
                        ->setExpires($accessToken->getExpires())
                        ->save();
                }
            );
        return $apiClient;
    }
}
