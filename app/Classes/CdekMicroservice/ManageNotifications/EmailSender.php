<?php

namespace App\Classes\CdekMicroservice\ManageNotifications;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EmailSender
{
    const URL = 'http://managenotifications.dev2.cdek.ru/api/v2/send/email';

    public function send()
    {
        $response = Http::withHeaders(['X-Auth-Token' => '4873934fe3d54d9c8c9ffca3101e4b3e'])
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
