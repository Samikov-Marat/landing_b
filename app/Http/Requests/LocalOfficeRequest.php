<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalOfficeRequest extends FormRequest
{



    public function rules()
    {
        return [
            'code' => 'string',
            'subdomain' => 'string',
            'map_preset' => '',
            'utm_tag' => '',
            'utm_value' => '',
            'category' => '',
            'disabled' => 'boolean',
            'franchisee_id' => 'integer',
            'name' => 'array',
            'address' => 'array',
            'path' => 'array',
            'worktime' => 'array',
            'phone_old' => 'array',
            'phone_new' => 'array',
            'email_old' => 'array',
            'email_new' => 'array',
        ];
    }
}
