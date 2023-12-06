<?php

namespace App\Classes\Site\Amo;

use AmoCRM\Client\AmoCRMApiClient;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;

class AmoCRMApiClientVelocity
{
    public function getClient(): AmoCRMApiClient
    {
        $memento = new AccessTokenMemento(config('amo_velocity.oauth_tmp_file'));
        $memento->load();
        $token = new AccessToken([
                                     'access_token' => $memento->getAccessToken(),
                                     'refresh_token' => $memento->getRefreshToken(),
                                     'expires' => $memento->getExpires(),
                                     'baseDomain' => config('amo_velocity.account_base_domain'),
                                 ]);
        $apiClient = new AmoCRMApiClient(
            config('amo_velocity.client_id'),
            $memento->getClientSecret(),
            config('amo_velocity.redirect_uri')
        );
        $apiClient->setAccessToken($token)
            ->setAccountBaseDomain(config('amo_velocity.account_base_domain'))
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
