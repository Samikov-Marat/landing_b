<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminCurrencyRequest extends FormRequest
{

    public function rules()
    {
        return [
            'code' => 'required|integer',
            'name' => 'required|string',
            'symbol' => 'required|string'
        ];
    }
}
