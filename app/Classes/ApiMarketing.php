<?php


namespace App\Classes;

use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ApiMarketing
{
    const API_URI = 'http://192.168.1.162:8121/api/v1/landing';
    const TOKEN = 'PFpp_TFarNGuoqRbdDayoSV-DQUggkTtKb_5gKtt';

    public static function createRequest($form, $referer)
    {
        $message = PHP_EOL . 'Откуда: ' . $form['from'] . ' (код ' . $form['from_id'] . ') ' . PHP_EOL;
        $message .= 'Куда: ' . $form['to'] . ' (код ' . $form['to_id'] . ') ' . PHP_EOL;
        $message .= 'Вес: ' . $form['mass'] . ' кг' . PHP_EOL;
        $message .= 'Размер: ' . $form['length'] . 'x' . $form['width'] . 'x' . $form['height'] . ' см' . PHP_EOL;
        $message .= 'Тариф: ' . $form['tariff'] . PHP_EOL;
        $message .= 'Согласен на обработку персональных данных: ' . $form['agree'] . PHP_EOL;

        return [
            'subject' => 'Лендинг. Калькулятор.',
            'name' => $form['name'],
            'phone' => $form['phone'],
            'email' => $form['email'],
            'project_name' => 'Лендинг с админкой',
            'message' => $message,
            'country_id' => '-uk',
            'url' => Str::after($referer, '//'),
        ];
    }

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
        if (!$responseDecoded['success']) {
            throw new \Exception('Ошибка параметров');
        }
        return $responseDecoded;
    }


}
