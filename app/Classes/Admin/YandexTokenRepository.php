<?php

namespace App\Classes\Admin;

use App\YandexToken;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class YandexTokenRepository
{
    private $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public static function getInstance(string $code): self
    {
        return new static($code);
    }

    public function receiveToken()
    {
        $response = Http::asForm()->post('https://oauth.yandex.ru/token', [
            'grant_type' => 'authorization_code',
            'code' => $this->code,
            'client_id' => '0180b7d8d6684cabbeaba0a7fd26975d',
            'client_secret' => 'b0044b49531f42f58c54c1c1bb808260',
        ]);
        $decodedResponseBody = json_decode($response->body(), true);

        $login = YandexUserRepository::getInstance($decodedResponseBody['access_token'])
            ->getLogin();

        $yandexToken = YandexToken::select(['id', 'access_token', 'refresh_token', 'login', 'received_at'])
            ->where('login', $login)
            ->firstOrNew();
        $yandexToken->access_token = $decodedResponseBody['access_token'];
        $yandexToken->refresh_token = $decodedResponseBody['refresh_token'];
        $yandexToken->login = $login;
        $yandexToken->received_at = Carbon::now();
        $yandexToken->save();

        return $yandexToken->id;
    }
}
