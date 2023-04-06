<?php

namespace App\Classes\Site;

use App\TariffType;
use Exception;
use Illuminate\Http\Request;

class CalculatorJson
{
    public static function getJson(Request $request)
    {
        return json_encode([
                               'sender' => [
                                   'cityId' => $request->input('sender_city_uuid'),
                                   'contragentType' => 'FIZ',
                               ],
                               'receiver' => [
                                   'cityId' => $request->input('receiver_city_uuid'),
                                   'contragentType' => 'FIZ',
                               ],
                               'payer' => [
                                   'payerType' => 'sender',
                               ],
                               'orderParam' => [
                                   'orderTypeCode' => '1',
                                   'calcMode' => 'RECALC'
                               ],
                               'interfaceCode' => 'ec5_front',
                               'currencyMark' =>  static::getCurrencyMark($request->input('idCurrency')),
                               'calcDate' => date('Y-m-d'),
                               'packages' => [
                                   [
                                       'length' => $request->input('length'),
                                       'width' => $request->input('width'),
                                       'height' => $request->input('height'),
                                       'weight' => $request->input('mass'),
                                   ]
                               ]
                           ]);
    }

    public static function transformResponseBody($responseBody, $language)
    {

        $tariffTypes = TariffType::select(['id', 'ek_id',])
            ->with([
                       'tariffTypeTexts' => function ($query) use ($language) {
                           $query->where('language_code_iso', $language);
                       }
                   ])
            ->get();


        $tariffTypesIndexed = $tariffTypes->pluck('tariffTypeTexts', 'id');

        $decoded = json_decode($responseBody);
        $services = $decoded->serviceList;

        $foundTariffs = collect();
        foreach ($services as $service) {
            foreach ($service->modeDetails as $modeDetail) {
                $foundTariffs->push([
                                        'name' => $service->serviceName ?? '',
                                        'description' => $service->serviceDescription ?? '',
                                        'tariffEc4Id' => $modeDetail->tariffEc4Id ?? '0',
                                        'durationMin' => $modeDetail->durationMin ?? '',
                                        'durationMax' => $modeDetail->durationMax ?? '',
                                        'calendarPeriodMin' => $modeDetail->calendarPeriodMin ?? '',
                                        'calendarPeriodMax' => $modeDetail->calendarPeriodMax ?? '',
                                        'price' => $modeDetail->price ?? '0',
                                        'tariffTypeId' => $modeDetail->modeCode,
                                        'tariffTypeName' => $modeDetail->modeName,
                                    ]);
            }
        }

        $tariffTranslator = new TariffTranslator($foundTariffs->pluck('tariffEc4Id', 'tariffEc4Id'), $language);


        $foundTariffs = $foundTariffs->sort(function ($tariff, $tariffNext) {
            return (float)$tariff['price'] > (float)$tariffNext['price'];
        })->values();

        $foundTariffs->transform(function ($item, $key) use ($tariffTranslator, $tariffTypesIndexed) {
            $item['priceString'] = number_format($item['price'], 2, '.', '&nbsp;');
            try {
                $tariffTranslate = $tariffTranslator->get($item['tariffEc4Id']);
                $item['nameLocalized'] = $tariffTranslate->name;
                $item['descriptionLocalized'] = $tariffTranslate->description;
            } catch (Exception $exception) {
                $item['nameLocalized'] = $item['name'];
                $item['descriptionLocalized'] = $item['description'];
            }

            try {
                $item['tariffTypeLocalized'] = $tariffTypesIndexed[$item['tariffTypeId']][0]->name;
            } catch (Exception $exception) {
                $item['tariffTypeLocalized'] = $item['tariffTypeName'];
            }
            return $item;
        });

        return $foundTariffs;
    }

    private static function getCurrencyMark($code): string
    {
        $marks = [
            '1' => 'RUB',
            '2' => 'KZT',
            '3' => 'USD',
            '4' => 'EUR',
            '5' => 'GBP',
            '6' => 'CNY',
            '7' => 'BYN',
            '8' => 'UAH',
            '9' => 'KGS',
            '10' => 'AMD',
            '11' => 'TRY',
            '12' => 'THB',
            '13' => 'KRW',
            '14' => 'AED',
            '15' => 'UZS',
            '16' => 'MNT',
            '17' => 'PLN',
            '18' => 'AZN',
            '19' => 'GEL',
            '20' => 'BGN',
            '21' => 'VND',
            '22' => 'ILS',
            '55' => 'JPY',
            '56' => 'CZK',
            '57' => 'PKR',
            '58' => 'INR',
            '59' => 'AUD',
            '60' => 'IDR',
            '89' => 'TJS',
            '91' => 'RSD',
            '92' => 'BDT',
            '93' => 'IRR',
            '94' => 'HKD',
            '97' => 'EEK',
            '98' => 'KHR',
            '99' => 'LAK',
            '100' => 'LAK',
            '101' => 'NZD',
        ];
        return $marks[$code];
    }

}
