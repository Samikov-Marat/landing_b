<?php

namespace App\Classes\CdekMicroservice\Pdp;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SimpleAuthentication
{
    private $url;
    private $user;
    private $password;

    public function __construct()
    {
        $this->url = config('manage_notifications.pdp_auth_api_url') . '/web/simpleauth/authorize';
        $this->user = config('manage_notifications.pdp_auth_user');
        $this->password = config('manage_notifications.pdp_auth_password');
    }

    public static function getInstance(): self
    {
        return new static();
    }

    public function authorize()
    {
        $response = Http::withHeaders(['X-User-Lang' => 'rus'])
            ->asJson()
            ->post($this->url, [
                'user' => $this->user,
                'hashedPass' => md5($this->password),
            ]);
        if ($response->clientError()) {
            Log::error('Не удалось получить токен', ['body' => $response->body()]);
            throw new Exception('Ошибка идентификации');
        }
        if ($response->failed()) {
            Log::error('Не удалось получить токен. Возможно, сервер сломался.');
            throw new Exception('Не удалось получить токен');
        }
        return new SimpleAuthenticationResponse($response->json());
    }
}
