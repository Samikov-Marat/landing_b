<?php

namespace App\Classes\Site\Amo;

use Illuminate\Http\Request;

class AmoFormFranchise
{
    public static function get(Request $request)
    {
        return [
            '2114857' => $request->input('name'),
            '2114859' => $request->input('phone'),
            '2114861' => $request->input('whatsapp'),
            '2114863' => $request->input('email'),
            '2114865' => $request->input('city'),
        ];
    }
}
