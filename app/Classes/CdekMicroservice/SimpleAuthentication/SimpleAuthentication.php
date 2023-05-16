<?php

namespace App\Classes\CdekMicroservice\SimpleAuthentication;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SimpleAuthentication
{
    const URL = 'http://pdp.qa2.k8s-local.cdek.ru/web/simpleauth/authorize';


    public function authorize()
    {
        $response = Http::withHeaders(['X-User-Lang' => 'rus'])
            ->asJson()
            ->post(self::URL, [
                'user' => 'landing',
                'hashedPass' => md5('e*iBryt5'),
//                'hashedPass' => md5('qwR@htf7'),
            ]);

        if ($response->clientError()) {
            Log::error('Не удалось получить токен', ['body' => $response->body()]);
            throw new Exception('Ошибка идентификации');
        }
        if ($response->failed()) {
            Log::error('Не удалось получить токен. Возможно, сервер сломался.');
            throw new Exception('Не удалось получить токен');
        }
        dump($response->body());
        return new SimpleAuthenticationResponse($response->json());
    }
}
