<?php

namespace App\Exceptions;

use App\Classes\AuthLoginReturn;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        if ($e instanceof AliasNeedAuthentication) {
            AuthLoginReturn::set($e->url);
//            if(!$request->isSecure()){
//                return redirect(env('ALIAS_REDIRECT'));
//            }
            return redirect()->route('login');
        }
        return parent::render($request, $e);
    }
}
