<?php

namespace App\Classes\Site\CalculatorJson;

use App\Classes\Domain;
use App\Http\Requests\CalculatorRequest;
use phpDocumentor\Reflection\Types\Integer;

class CalculatorJsonGenerator implements JsonGeneratorRequestToApi
{
    private $request;
    private $domain;

    public function __construct (CalculatorRequest $request, Domain $domain) {
        $this->request = $request;
        $this->domain = $domain;
    }
    public function getJson()
    {
        return json_encode([
            'sender' => [
                'cityId' => $this->request->sender_city_uuid,
                'contragentType' => $this->request->customer_type ?: 'UR',
            ],
            'receiver' => [
                'cityId' => $this->request->receiver_city_uuid,
                'contragentType' => $this->request->receiver_type ?: 'FIZ',
            ],
            'payer' => [
                'contractId' => $this->getContractId(),
                'payerType' => 'sender',
            ],
            'orderParam' => [
                'orderTypeCode' => '1',
                'calcMode' => 'RECALC'
            ],
            'interfaceCode' => 'ec5_front',
            'currencyMark' => static::getCurrencyMark($this->request->idCurrency),
            'calcDate' => date('Y-m-d'),
            'packages' => [
                [
                    'length' => $this->request->length,
                    'width' => $this->request->width,
                    'height' => $this->request->height,
                    'weight' => $this->request->mass,
                ]
            ],
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

    private function getContractId () {
        $domainName = $this->domain->get();
        return config('special_sender_contracts')[$domainName] ?? config('calculator.sender_contract_id');
    }
}