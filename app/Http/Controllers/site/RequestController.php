<?php

namespace App\Http\Controllers\site;

use App\Classes\ApiMarketing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class RequestController extends Controller
{
    public function send(Request $request)
    {
        try {
            $apiMarketingRequest = ApiMarketing::createRequest($request->all(), $_SERVER['HTTP_REFERER']);
            return ApiMarketing::send($apiMarketingRequest);
        } catch (\Exception $e) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function feedback(Request $request)
    {
        try {
            $apiMarketingRequest = ApiMarketing::createFeedback($request->all(), $_SERVER['HTTP_REFERER']);
            return ApiMarketing::send($apiMarketingRequest);
        } catch (\Exception $e) {
            abort(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOfficeList(Request $request)
    {
        $fullPath = Storage::disk('local')->path('yandex_map_log.txt');
        $handle = fopen($fullPath, 'w');
        try {
            fwrite($handle, var_export($request->all(), true));
        } catch (\Exception $e) {
            fclose($handle);
            throw $e;
        }
        fclose($handle);
        dump($this->repository->find(40,64,41,65));
    }
}
