<?php

namespace App\Classes\Site;

use App\TariffType;
use Exception;
use Illuminate\Support\Collection;

class CalculatorResponse
{
    public function transformResponseBody(
        $responseBody,
        $language,
        string $clientsType,
        string $page
    ): Collection {
        $availabilityTariffsByClientType = $this->getAvailableTariffsByClientType($clientsType);
        $availabilityTariffsByPage = $this->getAvailableTariffsByPage($availabilityTariffsByClientType,
            $page);

        $tariffTypes = $this->getTariffTypes($language);

        $tariffTypesIndexed = $tariffTypes->pluck('tariffTypeTexts', 'id');

        $decoded = json_decode($responseBody);
        $services = $decoded->serviceList;

        $foundTariffs = collect();

        foreach ($services as $service) {
            foreach ($service->modeDetails as $modeDetail) {
                if (in_array($service->serviceName ?? '', $availabilityTariffsByPage)) {
                    $foundTariffs->push($this->getTariffFromService($service, $modeDetail));
                }
            }
        }

        $tariffTranslator = new TariffTranslator($foundTariffs->pluck('tariffEc4Id', 'tariffEc4Id'),
            $language);


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

    private function getTariffTypes(string $language): Collection
    {
        return TariffType::select(['id', 'ek_id',])
            ->with([
                'tariffTypeTexts' => function ($query) use ($language) {
                    $query->where('language_code_iso', $language);
                },
            ])
            ->get();
    }

    private function getAvailableTariffsByClientType(string $clientsType): array
    {
        $availabilityTariffs = [
            'B2B' => [
                'Business Express',
                'Business Cargo Express',
                'Documents Express',
                'Documents Standard',
            ],
            'B2C' => [
                'E-com Express',
                'E-com Standard',
                'Documents Express',
                'Documents Standard',
                'Международный экспресс грузы',
                'Международный экспресс документы',
                'Parcel Express'
            ],
            'C2C' => [
                'Parcel Express'
            ],
        ];

        if (array_key_exists($clientsType, $availabilityTariffs)) {
            return $availabilityTariffs[$clientsType];
        }
        return [
            'E-com Express',
            'E-com Standard',
            'Parcel Express',
            'Parcel Standard',
            'Business Express',
            'Business Cargo Express',
            'Documents Express',
            'Documents Standard',
            'Международный экспресс грузы',
            'Международный экспресс документы',
            'Parcel Express'
        ];
    }

    private function getAvailableTariffsByPage(array $tariffs, string $page): array
    {
        $availabilityTariffs = [
            'documents' => [
                'Documents Express',
                'Documents Standard',
                'Documents Econom',
            ],
        ];

        if (array_key_exists($page, $availabilityTariffs)) {
            return $availabilityTariffs[$page];
        }
        return $tariffs;
    }

    private function getTariffFromService($service, $modeDetail)
    {
        return [
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
            'tariffUuid' => $service->generalServiceId ?? ''
        ];
    }

}
