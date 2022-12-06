<?php

namespace App\Classes\Site;

use App\Tariff;
use App\TariffType;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
                               'currencyMark' => 'RUB',
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

    public static function transformResponseBody($responseBody)
    {
        $language = 'eng';
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
        dd($services);
        $foundTariffs = collect();
        foreach ($services as $service) {
            foreach ($service->modeDetails as $modeDetail) {
                $foundTariffs->push([
                                        'name' => $service->name ?? '',
                                        'tariffEc4Id' => $service->tariffEc4Id ?? '0',
                                        'durationMin' => $modeDetail->durationMin ?? '',
                                        'durationMax' => $modeDetail->durationMax ?? '',
                                        'calendarPeriodMin' => $modeDetail->calendarPeriodMin ?? '',
                                        'calendarPeriodMax' => $modeDetail->calendarPeriodMax ?? '',
                                        'price' => $modeDetail->price ?? '0',
                                    ]);
            }
        }

        $tariffTranslator = new TariffTranslator($foundTariffs->pluck('tariffEc4Id', 'tariffEc4Id'), $language);

        $foundTariffs->sort(function ($tariff, $tariffNext) {
            return $tariff['price'] > $tariffNext['price'];
        });

        $foundTariffs->transform(function ($item, $key) use ($tariffTranslator) {
            $item['priceString'] = number_format($item['price'], 2, '.', '&nbsp;');
            $tariffTranslate = $tariffTranslator->get($item['tariffEc4Id']);
//            $item['name'] = $tariffTranslate->name;
//            $item['description'] = $tariffTranslate->description;
            return $item;
        });

        return $foundTariffs;
    }

}
