<?php

namespace App\Classes\Site\CalculatorJson;

use App\Http\Requests\CalculatorRequest;
use Illuminate\Http\Request;

interface JsonGeneratorRequestToApi
{
    public  function getJson(CalculatorRequest $request);
}
