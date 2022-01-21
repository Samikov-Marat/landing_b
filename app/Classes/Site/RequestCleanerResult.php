<?php

namespace App\Classes\Site;

class RequestCleanerResult
{
    private $result;

    public function __construct()
    {
        $this->result = [];
    }

    public function add($k, $v)
    {
        $this->result[$k] = $v;
    }

    public function addOnlyNotEmpty($k, $v)
    {
        if (count($v)) {
            $this->result[$k] = $v;
        }
    }

    public function getArray()
    {
        return $this->result;
    }
}
