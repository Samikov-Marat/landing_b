<?php

namespace App\Classes\Site\CalculatorJson;

use Illuminate\Http\Request;

class LegalPersonToLegalPerson implements JsonGeneratorRequestToApi
{
    public function getJson(Request $request)
    {
        return json_encode([
                               'sender' => [
                                   'cityId' => $request->input('sender_city_uuid'),
                                   'contragentType' => 'UR',
                               ],
                               'receiver' => [
                                   'cityId' => $request->input('receiver_city_uuid'),
                                   'contragentType' => 'UR',
                               ],
                               'payer' => [
                                   'contractId' => '977d7aaf-ec3e-467d-a6e3-abeb10fd44cd',
                                   'payerType' => 'sender',
                               ],
                               'orderParam' => [
                                   'orderTypeCode' => '1',
                                   'calcMode' => 'RECALC'
                               ],
                               'interfaceCode' => 'ec5_front',
                               'currencyMark' => static::getCurrencyMark($request->input('idCurrency')),
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
