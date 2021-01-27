<?php

namespace App\Http\Controllers\site;

use App\Classes\ApiMarketing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestController extends Controller
{
    public function send(Request $request){
        try{
            $request->input('from_id');
            $apiMarketingRequest = ApiMarketing::createRequest($request->all(), $_SERVER['HTTP_REFERER']);
            return ApiMarketing::send($apiMarketingRequest);
        }
        catch (\Exception $e){
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
}
