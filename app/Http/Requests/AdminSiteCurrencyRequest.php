<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminSiteCurrencyRequest extends FormRequest
{

    public function rules()
    {
        return [
            'currencyCode' => 'required|integer'
        ];
    }
}
