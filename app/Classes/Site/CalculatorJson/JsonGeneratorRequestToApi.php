<?php

namespace App\Classes\Site\CalculatorJson;

use Illuminate\Http\Request;

interface JsonGeneratorRequestToApi
{
    public  function getJson(Request $request);
}
