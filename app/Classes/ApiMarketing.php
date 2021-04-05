<?php


namespace App\Classes;

use App\Exceptions\LocalOfficeNotFoundByUtm;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ApiMarketing
{
    const API_URI = 'http://192.168.1.162:8121/api/v1/landing';
    const TOKEN = 'PFpp_TFarNGuoqRbdDayoSV-DQUggkTtKb_5gKtt';

    public static function createRequest($form, $domain)
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
            'country_id' => static::getCountryId($domain),
            'url' => $domain,
        ];
    }

    public static function createFeedback($form, $domain)
    {
        return [
            'subject' => 'Лендинг. Обратная связь.',
            'name' => $form['name'],
            'phone' => $form['phone'],
            'email' => $form['email'],
            'project_name' => 'Лендинг с админкой',
            'message' => $form['message'],
            'country_id' => static::getCountryId($domain),
            'url' => $domain,
        ];
    }

    public static function getCountryId($domain)
    {
        try {
            $localOfficeRepository = new UtmSiteRepository($domain);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return '';
        }
        $old = Cookie::get(UtmCookie::COOKIE_NAME);
        if (!is_null($old)) {
            try {
                $oldUtmCookie = UtmCookie::getInstanceFromJson($old);
                return $localOfficeRepository->getCategory($oldUtmCookie->getData());
            } catch (LocalOfficeNotFoundByUtm $e) {
                Log::debug($e->getMessage());
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
        try {
            return CategoryInTurn::getInstance($localOfficeRepository->site->localOffices)
                ->getNext();
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
        return '';
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
