<?php

namespace App\Classes;

use Illuminate\Http\Request;

class Domain
{
    var $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function getInstance(Request $request)
    {
        return new static($request);
    }

    public function get()
    {
        $domain = $this->request->server('HTTP_HOST');
        // TODO: Сделать псевдонимы
        if ('localhost:89' == $domain) {
            $domain = 'landing.dev.cdek.ru';
        }
        return $domain;
    }
}
