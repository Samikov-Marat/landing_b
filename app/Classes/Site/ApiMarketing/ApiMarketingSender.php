<?php

namespace App\Classes\Site\ApiMarketing;

use GuzzleHttp\Client;
use Illuminate\Http\Response;

class ApiMarketingSender
{
    const API_URI = 'http://192.168.1.162:8121/api/v1/landing';
    const TOKEN = 'PFpp_TFarNGuoqRbdDayoSV-DQUggkTtKb_5gKtt';

    public static function send($apiMarketingRequest)
    {
        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . self::TOKEN,
            'Content-Type' => 'application/json',
            'cache-control' => 'no-cache',
        ];
        try {
            $response = $client->request(
                'POST',
                self::API_URI,
                ['headers' => $headers, 'json' => $apiMarketingRequest]
            );
        } catch (\Exception $e) {
            throw new \Exception('Ошибка API markerting. При отправке запроса.');
        }

        if ($response->getStatusCode() != Response::HTTP_OK) {
            throw new \Exception('Ошибка API markerting. HTTP-код' . $response->getStatusCode());
        }
        $responseDecoded = json_decode($response->getBody()->getContents(), true);
        self::checkResponse($responseDecoded);
        return $responseDecoded;
    }

    private static function checkResponse($responseDecoded)
    {
        if (!array_key_exists('success', $responseDecoded)) {
            throw new \Exception('Неправильный ответ сервера (нет поля success)');
        }
        if ($responseDecoded['success']) {
            return;
        }
        if (!array_key_exists('error', $responseDecoded)) {
            throw new \Exception('Неправильный ответ сервера (нет поля error)');
        }
        throw new \Exception('Ошибка параметров ' . $responseDecoded['error']);
    }
}
