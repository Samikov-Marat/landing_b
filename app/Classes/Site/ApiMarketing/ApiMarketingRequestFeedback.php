<?php

namespace App\Classes\Site\ApiMarketing;

class ApiMarketingRequestFeedback extends ApiMarketingRequestBase
{
    public function get(): array
    {
        return [
            'subject' => 'Лендинг. Форма обратной связи.',
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'project_name' => $this->domain,
            'message' => $this->input('message') . PHP_EOL . $this->getRequestDatetime(),
            'country_id' => $this->apiMarketingCategory,
            'url' => $this->input('url', $this->domain),
        ];
    }

}