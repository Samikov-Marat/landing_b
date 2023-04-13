<?php

namespace App\Classes\Site;

use App\Classes\Site\CalculatorJson\JsonGeneratorRequestToApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Calculator
{
    private $jsonGenerator;
    private $url;

    function __construct(JsonGeneratorRequestToApi $jsonGenerator, string $url)
    {
        $this->jsonGenerator = $jsonGenerator;
        $this->url = $url;
    }

    public static function getInstance(JsonGeneratorRequestToApi $jsonGenerator, string $url): self
    {
        return new static($jsonGenerator, $url);
    }

    public function getTariffs(Request $request): string
    {
        return Http::withHeaders(['X-User-Lang' => CalculatorLanguage::getLanguage($request->input('language'))])
            ->asJson()
            ->withBody(
                 $this->jsonGenerator->getJson($request),
                'application/json'
            )
            ->post($this->url)
            ->throw()
            ->body();
    }
}
