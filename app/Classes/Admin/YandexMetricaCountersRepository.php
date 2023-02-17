<?php

namespace App\Classes\Admin;

use Illuminate\Support\Facades\Http;

class YandexMetricaCountersRepository
{
    private $token;
    private $counterListUrl;
    private $includeGoals;

    public function __construct(string $token, bool $includeGoals = false)
    {
        $this->token = $token;
        $this->counterListUrl = 'https://api-metrika.yandex.net/management/v1/counters';
        $this->includeGoals = $includeGoals;
    }

    public static function getInstance(string $token, bool $includeGoals = false): self
    {
        return new static($token, $includeGoals);
    }

    public function getCounters()
    {
        $countersInfo = $this->getCounterInfo();
        return $countersInfo['counters'];
    }

    public function getCounterInfo()
    {
        $response = Http::withHeaders($this->getHeaders())
            ->get($this->getUrlWithParams());
        return json_decode($response->body(), true);
    }

    private function getHeaders()
    {
        return [
            'Authorization' => 'OAuth ' . $this->token,
            'Content-Type' => 'application/x-yametrika+json',
        ];
    }

    private function getUrlWithParams()
    {
        return $this->counterListUrl . '?' . http_build_query($this->getParams());
    }

    private function getParams(): array
    {
        $params = [
            'status' => 'Active',
        ];

        if ($this->includeGoals) {
            $params['field'] = 'goals';
        }
        return $params;
    }

}
