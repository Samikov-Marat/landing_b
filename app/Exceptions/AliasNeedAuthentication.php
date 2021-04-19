<?php

namespace App\Exceptions;

use Exception;


class AliasNeedAuthentication extends Exception
{
    var $url;

    public function __construct($message, $url)
    {
        parent::__construct($message);
        $this->url = $url;
    }

}
