<?php

namespace App\Classes\Site\ApiMarketing;

class ApiMarketingRequestPresentation extends ApiMarketingRequestBase
{
    public function get(): array
    {
        return [
            'subject' => 'Лендинг. Запрос презентации.',
            'name' => $this->input('name'),
            'phone' => $this->input('phone'),
            'email' => $this->input('email'),
            'project_name' => $this->domain,
            'message' => $this->getRequestDatetime(),
            'country_id' => $this->apiMarketingCategory,
            'url' => $this->input('url', $this->domain),
        ];
    }

}
