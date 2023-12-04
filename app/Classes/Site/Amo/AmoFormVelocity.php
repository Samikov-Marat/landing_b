<?php

namespace App\Classes\Site\Amo;

use Illuminate\Http\Request;

class AmoFormVelocity
{
    public static function get(Request $request)
    {
        return [
            '2114857' => $request->input('name'),
            '2114859' => $request->input('phone'),
            '2114863' => $request->input('email'),
            '2138787' => $request->input('clientType'),
            '2139655' => $request->input('message'),
        ];
    }
}
