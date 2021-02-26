<?php

namespace App\Http\Controllers\site;

use App\Classes\ApiMarketing;
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

        $features = [];
        foreach ($offices as $office){
            $features[] = [
                'type' => 'Feature',
                'id' => $office->code,
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [(float)$office->coordinates->x, (float)$office->coordinates->y],
                ],
                'properties' => [
                    'balloonContent' => $office->address . '<br>' .
                        $office->addressComment . '<br>' .
                        $office->email   . '<br>' .
                        $office->phone,
                    'clusterCaption' => 'CDEK',
                    'hintContent' => $office->address
                ]

            ];
        }

        $FeatureCollection = [
            'type'=> 'FeatureCollection',
            'features' => $features,
        ];

        return response()->json($FeatureCollection);
    }
}
