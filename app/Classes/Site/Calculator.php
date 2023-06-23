<?php

namespace App\Classes\Site;

use App\Classes\Site\CalculatorJson\JsonGeneratorRequestToApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Calculator
{

    public function getTariffs(
        Request $request,
        JsonGeneratorRequestToApi $jsonGenerator,
        string $url
    ): string {
        return Http::withHeaders(['X-User-Lang' => CalculatorLanguage::getLanguage($request->input('language'))])
            ->asJson()
            ->withBody(
                $jsonGenerator->getJson($request),
                'application/json'
            )
            ->post($url)
            ->throw()
            ->body();
    }
}
