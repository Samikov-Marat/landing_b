<?php

namespace App\Http\Controllers\site;

use App\Classes\ApiMarketing;
use App\Classes\MapJsonCallback;
use App\Classes\OfficeRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class RequestController extends Controller
{
    public function send(Request $request)
    {
        try {
            $apiMarketingRequest = ApiMarketing::createRequest($request->all(), $_SERVER['HTTP_REFERER']);
            return ApiMarketing::send($apiMarketingRequest);
        } catch (\Exception $e) {
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function feedback(Request $request)
    {
        try {
            $apiMarketingRequest = ApiMarketing::createFeedback($request->all(), $_SERVER['HTTP_REFERER']);
            return ApiMarketing::send($apiMarketingRequest);
        } catch (\Exception $e) {
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOfficeList(Request $request)
    {
        $coordinates = explode(',', $request->input('bbox'));
        foreach ($coordinates as $value) {
            if (!is_numeric($value)) {
                abort(HttpResponse::HTTP_BAD_REQUEST);
            }
        }
        $repository = new OfficeRepository();
        $offices = $repository->find($coordinates[1], $coordinates[0], $coordinates[3], $coordinates[2]);

        $responseGenerator = new MapJsonCallback();
        $responseGenerator->setCallbackName($request->input('callback'));
        $responseGenerator->start();
        foreach ($offices as $office) {
            $responseGenerator->add($office);
        }
        $responseGenerator->finish();
    }
}
