<?php


namespace App\Classes;

use App\Exceptions\LocalOfficeNotFoundByUtm;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
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
        // TODO:
        //        $message .= 'Дата заявки ' . Carbon::now()->setTimezone(-5)->toDayDateTimeString() . PHP_EOL;
        //        dd(Carbon::now()->setTimezone(-5)->toDayDateTimeString());
        return [
            'subject' => 'Лендинг. Калькулятор.',
            'name' => $form['name'],
            'phone' => $form['phone'],
            'email' => $form['email'],
            'project_name' => $domain,
            'message' => $message,
            'country_id' => static::getCountryId($domain),
            'url' => $form['url'] ?? $domain,
        ];
    }

    public static function createFeedback($form, $domain)
    {
        return [
            'subject' => 'Лендинг. Форма обратной связи.',
            'name' => $form['name'],
            'email' => $form['email'],
            'project_name' => $domain,
            'message' => $form['message'],
            'country_id' => static::getCountryId($domain),
            'url' => $form['url'] ?? $domain,
        ];
    }

    public static function createPresentation($form, $domain)
    {
        return [
            'subject' => 'Лендинг. Запрос презентации.',
            'name' => $form['name'] ?? '',
            'phone' => $form['phone'] ?? '',
            'email' => $form['email'] ?? '',
            'project_name' => $domain,
            'message' => '',
            'country_id' => static::getCountryId($domain),
            'url' => $domain,
        ];
    }

    public static function createFeedbackReview($form, $domain)
    {
        return [
            'subject' => 'Лендинг. Отзыв.',
            'name' => $form['name'] ?? '',
            'phone' => $form['phone'] ?? '',
            'email' => $form['email'] ?? '',
            'project_name' => $domain,
            'message' => $form['message'] ?? '',
            'country_id' => static::getCountryId($domain),
            'url' => $form['url'] ?? $domain,
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
        self::checkResponse($responseDecoded);
        return $responseDecoded;
    }

    private static function checkResponse($responseDecoded){
        if(!array_key_exists('success', $responseDecoded)){
            throw new \Exception('Неправильный ответ сервера (нет поля success)');
        }
        if($responseDecoded['success']){
            return;
        }
        if(!array_key_exists('error', $responseDecoded)){
            throw new \Exception('Неправильный ответ сервера (нет поля error)');
        }
        throw new \Exception('Ошибка параметров ' . $responseDecoded['error']);
    }
}
