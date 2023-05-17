<?php

namespace App\Classes\CdekMicroservice\ManageNotifications;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class ManageNotifications
{
    private $url;
    private $XAuthToken;

    public function __construct()
    {
        $this->url = config('manage_notifications.manage_notifications_api_url') . '/api/v2/send/email';
    }

    public static function getInstance(): self
    {
        return new static();
    }

    public function setToken($XAuthToken): self
    {
        $this->XAuthToken = $XAuthToken;
        return $this;
    }

    public function send(ManageNotificationData $configuration): ManageNotificationResponse
    {
        $response = Http::withHeaders(['X-Auth-Token' => $this->XAuthToken])
            ->asJson()
            ->post($this->url, $configuration->getAsArray());
        if ($response->failed()) {
            Log::error('Ошибка отправки письма', ['body' => $response->body()]);
            throw new Exception('Не удалось оправить сообщение');
        }
        return new ManageNotificationResponse($response->json());
    }
}
