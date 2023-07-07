<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CalculatorRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'customer_type' => $this->customer_type ?? 'B',
            'receiver_type' => $this->receiver_type ?? 'C'
        ]);
    }

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
            'customer_type' => Rule::in(['B', 'C']),
            'receiver_type' => Rule::in(['B', 'C']),
            'page' => 'required|string'
        ];
    }
}
