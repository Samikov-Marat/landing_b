<?php

namespace App\Classes\Site;

use App\Mail\site\support\ForwardMail;
use App\Mail\site\support\ShoppingMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SupportEmail
{
    public static function sendShopping(Request $request)
    {
        try {
            Mail::to(config('support.shopping_email'))
                ->send(new ShoppingMail($request));

        }catch (Exception $e){
            Log::error($e);
        }
    }

    public static function sendForward(Request $request)
    {
        Mail::to(config('support.forward_email'))
            ->send(new ForwardMail($request));
    }
}
