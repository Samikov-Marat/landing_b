<?php

namespace App\Classes\Site\Amo;

use Illuminate\Http\Request;

class AmoFormVelocity
{
    public static function get(Request $request)
    {
        return [
            '1289927' => $request->input('clientType'),
            '1289931' => $request->input('name'),
            '1289933' => $request->input('phone'),
            '1289935' => $request->input('email'),
            '1289939' => $request->input('message'),
        ];
    }
}
