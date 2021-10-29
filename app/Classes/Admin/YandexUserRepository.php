<?php

namespace App\Classes\Admin;

use Illuminate\Support\Facades\Http;

class YandexUserRepository
{
    private $token;
    private $url;

    public function __construct(string $token)
    {
        $this->token = $token;
        $this->url = 'https://login.yandex.ru/info';
    }

    public static function getInstance(string $token): self
    {
        return new static($token);
    }

    public function getLogin()
    {
        $countersInfo = $this->getLoginInfo();
        return $countersInfo['login'];
    }

    public function getLoginInfo()
    {
        $response = Http::withHeaders($this->getHeaders())
            ->get($this->getUrlWithParams());
        return json_decode($response->body(), true);
    }

    private function getHeaders()
    {
        return [
            'Authorization' => 'OAuth ' . $this->token,
        ];
    }

    private function getUrlWithParams()
    {
        return $this->url . '?' . http_build_query($this->getParams());
    }

    private function getParams()
    {
        return [
            'format' => 'json',
        ];
    }
}
