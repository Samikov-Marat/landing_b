<?php


namespace App\Classes;

use GuzzleHttp\Client;

class OfficeLoader
{
    var $url;

    public function __construct()
    {
        $this->url = env('OFFICES_GEO_XML');
    }

    public static function getInstance()
    {
        return new static();
    }

    public function loadTo($filename)
    {
        $client = new Client();
        $client->request('GET', $this->url, ['sink' => $filename]);
    }
}
