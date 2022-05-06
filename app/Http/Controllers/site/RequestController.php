<?php

namespace App\Http\Controllers\site;

use App\Classes\Domain;
use App\Classes\ImageResponse;
use App\Classes\MapJsonCallback;
use App\Classes\OfficeRepository;
use App\Classes\Site\AllowCookie;
use App\Classes\Site\ApiMarketing\ApiMarketing;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Language;
use App\Site;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class RequestController extends Controller
{
    public function send(Request $request)
    {
        try {
            return ApiMarketing::getInstance($request)->sendCalculatorRequest();
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function feedback(Request $request)
    {
        try {
            return ApiMarketing::getInstance($request)->sendFeedbackRequest();
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function order(Request $request)
    {
        try {
            return ApiMarketing::getInstance($request)->sendOrderRequest();
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function presentation(Request $request)
    {
        try {
            return ApiMarketing::getInstance($request)->sendPresentationRequest();
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function allowCookies(Request $request)
    {
        AllowCookie::getInstance($request)
            ->setAllow();
        return view('site.universal2.gtm_block');
    }

    public function feedbackReview(Request $request)
    {
        $domain = Domain::getInstance($request)->get();
        try {
            $site = Site::where('domain', $domain)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            Log::error($exception);
            abort(Response::HTTP_NOT_FOUND);
        }
        $language = Language::select('id')
            ->findOrFail($request->input('language_id'));

        try {
            $feedback = new Feedback();
            $feedback->site_id = $site->id;
            $feedback->language_id = $language->id;
            $feedback->name = $request->input('name', '');
            $feedback->email = $request->input('email', '');
            $feedback->text = $request->input('text', '');
            $feedback->writing_date = Carbon::now();
            $feedback->published = false;
            $feedback->save();

            return response('saved', 200)
                ->header('Content-Type', 'text/plain');
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getOfficeList(Request $request)
    {
        $coordinates = explode(',', $request->input('bbox'));
        foreach ($coordinates as $value) {
            if (!is_numeric($value)) {
                Log::error(
                    'Формат координат в запросе неверный. Не число в одной из координат' . var_export($value, true)
                );
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
                ->select('id', 'site_id', 'url', 'path', 'updated_at')
                ->where('url', '/' . $imageUrl)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            Log::error(new \Exception('Не найдена ' . $imageUrl));
            abort(Response::HTTP_NOT_FOUND);
        }
        $imageResponse = ImageResponse::getInstance()->setPath($image->path);
        $hash = $image->updated_at->format('Y-m-d H:i:s');
        if ($request->header('If-None-Match') == $hash) {
            abort(HttpResponse::HTTP_NOT_MODIFIED);
        }
        return response()->file(
            $imageResponse->getPath(),
            [
                'Content-Type' => $imageResponse->getMimeTypeByUrl($image->url),
                'ETag' => $hash,
            ]
        );
    }
}
