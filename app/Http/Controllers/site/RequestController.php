<?php

namespace App\Http\Controllers\site;

use App\Classes\ApiMarketing;
use App\Classes\DatabaseSynchronizer;
use App\Classes\Domain;
use App\Classes\MapJsonCallback;
use App\Classes\OfficeRepository;
use App\Http\Controllers\Controller;
use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
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

    public function images(Request $request, $imageUrl)
    {
        $domain = Domain::getInstance($request)->get();

        try {
            $site = Site::where('domain', $domain)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(Response::HTTP_NOT_FOUND);
        }
        try {
            $image = $site->images()
                ->select('id', 'site_id', 'url', 'path')
                ->where('url', '/' . $imageUrl)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $path = Storage::disk('images')->path($image->path);
        return response()->file($path);
    }
}
