<?php

namespace App\Classes\CdekMicroservice\TokenAuthorize;

use App\Classes\CdekMicroservice\SimpleAuthentication\SimpleAuthenticationResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TokenAuthorize
{
    const URL2 = 'http://pdp.qa2.k8s-local.cdek.ru/web/authuser/getfullinfo';


    public function authorize()
    {
        $response = Http::withHeaders(['X-User-Lang' => 'rus',
                                          'X-Auth-Token' => 'c004d595a3af47b796a02e3515f661d0',])
//                                          'X-Auth-Token' => '4873934fe3d54d9c8c9ffca3101e4b3e',])
            ->asJson()
            ->post(self::URL2, [
                'user' => 'landing',
                'hashedPass' => md5('qwR@htf7'),
            ]);
        dump($response->body());

//        if ($response->clientError()) {
//            Log::error('Не удалось получить токен', ['body' => $response->body()]);
//            throw new Exception('Ошибка идентификации');
//        }
//        if ($response->failed()) {
//            Log::error('Не удалось получить токен. Возможно, сервер сломался.');
//            throw new Exception('Не удалось получить токен');
//        }
//        return new SimpleAuthenticationResponse($response->json());
    }



}
