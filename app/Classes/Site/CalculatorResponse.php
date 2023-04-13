<?php

namespace App\Classes\Site;

use App\TariffType;
use Exception;
use Illuminate\Support\Collection;

class CalculatorResponse
{
    public static function transformResponseBody($responseBody, $language): Collection
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

        $foundTariffs->transform(function ($item) use ($tariffTranslator, $tariffTypesIndexed) {
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

}
