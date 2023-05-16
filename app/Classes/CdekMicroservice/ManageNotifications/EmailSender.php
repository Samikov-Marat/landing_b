<?php

namespace App\Classes\CdekMicroservice\ManageNotifications;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailSender
{
    const URL = 'http://10.2.72.56:8011/api/v2/send/email';

//Препрод: http://10.2.64.51:8011/swagger-ui/index.html#/send-message-controller
//QA2: http://10.2.72.56:8011/swagger-ui/index.html?configUrl=/v3/api-docs/swagger-config

    public function send()
    {
        $response = Http::withHeaders(['X-Auth-Token' => 'c004d595a3af47b796a02e3515f661d0'])
            ->asJson()
            ->post(self::URL, $this->getData());
        dd($response->body());
        if ($response->failed()) {
            Log::error('Ошибка отправки письма', ['body' => $response->body()]);
        }
    }

    private function getData(): array
    {
        return [
            'recipients' => [
                'm.samikov@cdek.ru'
            ],
            'templateGroupId' => 0,
            'templateParams' => [
                [
                    'key' => 'htmlContent',
                    'value' => '<h1>Hello!</h1>'
                ],
            ],
            'countryCode' => 1,
        ];
    }
}
