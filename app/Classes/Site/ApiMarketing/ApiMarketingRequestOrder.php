<?php

namespace App\Classes\Site\ApiMarketing;

class ApiMarketingRequestOrder extends ApiMarketingRequestBase
{
    public function get(): array
    {
        return [
            'subject' => 'Лендинг. Форма заказа.',
            'name' => $this->input('name'),
            'type' => $this->input('type'),
            'email' => $this->input('email'),
            'project_name' => $this->domain,
            'message' => $this->getMessage() . PHP_EOL . $this->getRequestDatetime(),
            'customer_type' => $this->input('customer_type'),
            'country_id' => $this->apiMarketingCategory,
            'url' => $this->input('url', $this->domain),
        ];
    }

    private function getMessage(): string
    {
        $m = [];
        $m['name'] = 'Имя';
        $m['phone'] = 'Телефон';
        $m['email'] = 'E-mail';
        $m['customer_type'] = 'Отправитель';
        $m['org'] = 'Наименование организации';
        $m['country_from'] = 'Страна отправителя';
        $m['country_to'] = 'Страна получателя';
        $m['country_to_string'] = 'Свой вариант страны получателя';
        $m['items_description'] = 'Описание товаров';
        $m['items_link'] = 'Ссылка на товар в интернете';
        $m['items_cost'] = 'Стоимость товаров в партии';

        $message = '';
        foreach ($this->request->all() as $key => $value) {
            if (isset($m[$key])) {
                $message .= $m[$key] . ': ' . $value . PHP_EOL;
            }
        }
        return $message;
    }
}
