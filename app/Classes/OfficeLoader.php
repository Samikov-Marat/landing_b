<?php


namespace App\Classes;

use GuzzleHttp\Client;

class OfficeLoader
{
    var $url;

    public function __construct($url)
    {
        $this->url = $url;
    }

    public static function getInstance($url)
    {
        return new static($url);
    }

    public function loadTo($filename)
    {
        $client = new Client();
        $client->request('GET', $this->url, ['sink' => $filename]);
    }
}
