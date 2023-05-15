<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminMapRequest extends FormRequest
{

    public function rules()
    {
        return [
            'state' => 'required|string'
        ];
    }
}
