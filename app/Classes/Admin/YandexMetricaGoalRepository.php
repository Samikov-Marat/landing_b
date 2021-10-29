<?php

namespace App\Classes\Admin;

use Illuminate\Support\Facades\Http;

class YandexMetricaGoalRepository
{
    private $token;
    private $counter;
    private $goal;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public static function getInstance($token)
    {
        return new static($token);
    }

    public function setCounter($counter)
    {
        $this->counter = $counter;
        return $this;
    }

    public function create($goal)
    {
        $this->goal = $goal;
        $response = Http::withHeaders($this->getHeaders())
            ->withBody(
                $this->getBody(),
                'application/x-yametrika+json'
            )
            ->post('https://api-metrika.yandex.net/management/v1/counter/' . $this->counter . '/goals');
    }


    private function getHeaders()
    {
        return [
            'Authorization' => 'OAuth ' . $this->token,
        ];
    }

    private function getBody()
    {
        return json_encode($this->getGoalParams());
    }

    private function getGoalParams()
    {
        return [
            'goal' => [
                'name' => $this->goal->description,
                'type' => 'action',
                'goal_source' => 'auto',
                'conditions' => [
                    [
                        'type' => 'exact',
                        'url' => $this->goal->name,
                    ]
                ],
            ],
        ];
    }

}
