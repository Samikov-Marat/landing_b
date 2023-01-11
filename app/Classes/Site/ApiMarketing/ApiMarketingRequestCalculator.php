<?php

namespace App\Classes\Site\ApiMarketing;

class ApiMarketingRequestCalculator extends ApiMarketingRequestBase
{
    public function get(): array
    {
        return [
            'subject' => 'Лендинг. Калькулятор.',
            'name' => $this->input('name'),
            'phone' => $this->input('phone'),
            'email' => $this->input('email'),
            'project_name' => $this->domain,
            'message' => $this->getMessage(),
            'customer_type' => $this->input('customer_type'),
            'country_id' => $this->apiMarketingCategory,
            'url' => $this->input('url', $this->domain),
        ];
    }

    function getMessage(): string
    {
        $simpleParametersKeys = [
            'from',
            'from_id',
            'to',
            'to_id',
            'mass',
            'length',
            'width',
            'height',
            'tariff',
            'agree',
        ];
        $messageParameters = [];
        foreach ($simpleParametersKeys as $key) {
            $messageParameters[$key] = $this->input($key);
        }
        $messageParameters['requestDatetime'] = $this->getRequestDatetime();
        $messageParameters['URL'] = $this->input('url');
        return view('api_marketing.request_calculator', $messageParameters)->render();
    }

}
