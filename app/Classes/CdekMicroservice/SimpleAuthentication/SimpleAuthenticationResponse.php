<?php

namespace App\Classes\CdekMicroservice\SimpleAuthentication;


class SimpleAuthenticationResponse
{
    private $httpClientResponse;

    public function __construct(array $httpClientResponse)
    {
        $this->httpClientResponse = $httpClientResponse;
    }

    public function getToken()
    {
        return $this->httpClientResponse['token'];
    }
}
