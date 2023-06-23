<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
{

    public function rules()
    {
        return [
            'jira_code' => 'required|max:255',
            'can_send' => 'boolean',
            'can_receive' => 'boolean'
        ];
    }

    public function messages()
    {
        return [
            'jira_code.required' => 'Не указано название страны',
            'can_send.boolean' => 'Значение города отправителя имеет некорректный тип',
            'can_receive.boolean' => 'Значение города получателя имеет некорректный тип',
        ];
    }
}
