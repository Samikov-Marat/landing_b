<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryTextRequest extends FormRequest
{
    public function rules()
    {
        return [
            'text' => 'string'
        ];
    }
}
