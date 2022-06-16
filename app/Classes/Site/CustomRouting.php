<?php

namespace App\Classes\Site;

use Illuminate\Http\Request;

class CustomRouting
{
    var $request;
    var $isSupportPage;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->isSupportPage = $this->request->route()->named('site.support');
    }

    static public function getInstance(Request $request): self
    {
        return new static($request);
    }

    public function isSupportPage(): bool
    {
        return $this->isSupportPage;
    }
}
