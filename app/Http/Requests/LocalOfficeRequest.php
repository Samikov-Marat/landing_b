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
            'map_preset' => 'string',
            'utm_tag' => 'string',
            'utm_value' => 'string',
            'category' => 'string',
            'disabled' => 'boolean',
            'franchisee_id' => 'integer',

            'name' => 'array',
            'name.*' => 'string',

            'address' => 'array',
            'address.*' => 'string',

            'path' => 'array',
            'path.*' => 'string',

            'worktime' => 'array',
            'worktime.*' => 'string',

            'phone_old' => 'array',
            'phone_old.*' => 'array:phone_text,phone_value,show_at_footer',
            'phone_old.*.phone_text' => 'string',
            'phone_old.*.phone_value' => 'string',
            'phone_old.*.show_at_footer' => 'string|integer|boolean',

            'phone_new' => 'array',
            'phone_new.*' => 'array:phone_text,phone_value,show_at_footer',
            'phone_new.*.phone_text' => 'string',
            'phone_new.*.phone_value' => 'string',
            'phone_new.*.show_at_footer' => 'string|integer|boolean',

            'email_old' => 'array',
            'email_old.*' => 'array:email,show_at_footer',
            'email_old.*.email' => 'string',
            'email_old.*.show_at_footer' => 'string|integer|boolean',

            'email_new' => 'array',
            'email_new.*' => 'array:email,show_at_footer',
            'email_new.*.email' => 'string',
            'email_new.*.show_at_footer' => 'string|integer|boolean',
        ];
    }
}
