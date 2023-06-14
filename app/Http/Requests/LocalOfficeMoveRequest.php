<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalOfficeMoveRequest extends FormRequest
{
    public function rules()
    {
        return [
            'direction' => "required|string"
        ];
    }
}
