<?php

namespace App\Classes\Site;

use App\Mail\site\support\ForwardMail;
use App\Mail\site\support\ShoppingMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportEmail
{
    public static function sendShopping(Request $request)
    {
        Mail::to(config('support.shopping_email'))
            ->send(new ShoppingMail($request));
    }

    public static function sendForward(Request $request)
    {
        Mail::to(config('support.forward_email'))
            ->send(new ForwardMail($request));
    }
}
