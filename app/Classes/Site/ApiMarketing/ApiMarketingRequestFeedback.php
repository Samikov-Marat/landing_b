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
            'message' =>
                'URL: ' . $this->input('form_url') . PHP_EOL .
                'Телефон: ' . $this->input('phone') . PHP_EOL .
                'Со страницы: ' . $this->input('form_place') . PHP_EOL .
                $this->input('message') . PHP_EOL .
                $this->getRequestDatetime(),
            'customer_type' => $this->input('customer_type'),
            'country_id' => $this->apiMarketingCategory,
            'url' => $this->input('url', $this->domain),
        ];
    }

}
