<?php

namespace App\Classes\CdekMicroservice\Pdp;


class SimpleAuthenticationResponse
{
    private $apiResponse;

    public function __construct(array $apiResponse)
    {
        $this->apiResponse = $apiResponse;
    }

    public function getToken()
    {
        return $this->apiResponse['token'];
    }
}
