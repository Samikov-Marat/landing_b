<?php

namespace App\Classes\Site;

use Illuminate\Support\Facades\Http;

class Recaptcha
{
    var $url;
    var $token;

    public function __construct($token)
    {
        $this->url = 'https://www.google.com/recaptcha/api/siteverify';
        $this->token = $token;
    }

    public static function getInstance($token)
    {
        return new static($token);
    }

    public function check()
    {
        $response = Http::timeout(5)
            ->asForm()
            ->post($this->url, $this->getParameters());

        $apiResponse = $response->json();
        return $apiResponse['success'];
    }

    private function getParameters()
    {
        return [
            'secret' => config('app.recapcha3_secret'),
            'response' => $this->token
        ];
    }
}
