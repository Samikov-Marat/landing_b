<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculatorRequest extends FormRequest
{
    public function rules()
    {
        return [
            'sender_city_uuid' => 'required|uuid',
            'receiver_city_uuid' => 'required|uuid',
            'mass' => 'required|integer',
            'height' => 'required|integer',
            'width' => 'required|integer',
            'length' => 'required|integer',
            'idCurrency' => 'required|integer',
            'language' => 'required|string',
            'customer_type' => 'string',
        ];
    }
}
