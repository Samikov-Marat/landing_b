<?php

namespace App\Http\Middleware;

use App\Classes\Site\Recaptcha;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;


class VerifyRecaptchaToken
{
    public function handle(Request $request, Closure $next)
    {
        if(!$request->input('recaptcha_token')){
            return response('Отсутствует recaptcha_token', HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
        $recaptchaValid = Recaptcha::getInstance($request->input('recaptcha_token'))
            ->check();
        if(!$recaptchaValid){
            Log::error('Recaptcha: подозрительный клиент');
            return response('Recaptcha: подозрительный клиент', HttpFoundationResponse::HTTP_BAD_REQUEST);
        }
        return $next($request);
    }
}
