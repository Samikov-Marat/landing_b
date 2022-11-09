<?php

namespace App\Http\Controllers\Site;

use App\Classes\Domain;
use App\Classes\ImageResponse;
use App\Classes\MapJsonCallback;
use App\Classes\OfficeRepository;
use App\Classes\Site\AllowCookie;
use App\Classes\Site\Amo\AmoCRMApiClientBuilder;
use App\Classes\Site\Amo\AmoSender;
use App\Classes\Site\ApiMarketing\ApiMarketing;
use App\Classes\Site\FormRequestRepository;
use App\Classes\Site\Jira\JiraSender;
use App\EngOffice;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Language;
use App\Office;
use App\Site;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class RequestController extends Controller
{
    public function send(Request $request)
    {
        try {
            FormRequestRepository::getInstance('send')
                ->save($request);
            return ApiMarketing::getInstance($request)->sendCalculatorRequest();
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function feedback(Request $request)
    {
        try {
            FormRequestRepository::getInstance('feedback')
                ->save($request);
            return ApiMarketing::getInstance($request)->sendFeedbackRequest();
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function support(Request $request)
    {
        if ($request->input('email') === 'error') {
            sleep(5);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        try {
            FormRequestRepository::getInstance('support')
                ->save($request);
            JiraSender::send($request);
            return 'success';
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function franchise(Request $request)
    {
        if ($request->input('email') === 'error') {
            sleep(5);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        try {
            FormRequestRepository::getInstance('franchise')
                ->save($request);

            $client = AmoCRMApiClientBuilder::getInstance()->getClient();
            AmoSender::getInstance($client)
                ->send($request->input('url'), [
                    '2114857' => $request->input('name'),
                    '2114859' => $request->input('phone'),
                    '2114861' => $request->input('whatsapp'),
                    '2114863' => $request->input('email'),
                    '2114865' => $request->input('city'),
                ]);
            return 'success';
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function order(Request $request)
    {
        try {
            FormRequestRepository::getInstance('order')
                ->save($request);
            return ApiMarketing::getInstance($request)->sendOrderRequest();
        } catch (\Exception $e) {
            Log::error($e);
            abort(HttpResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function presentation(Request $request)
    {
        try {
            FormRequestRepository::getInstance('presentation')
                ->save($request);

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
            FormRequestRepository::getInstance('feedbackReview')
                ->save($request);

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
                    'Формат координат в запросе неверный. Не число в одной из координат' . var_export($value,
                        true)
                );
                abort(HttpResponse::HTTP_BAD_REQUEST);
            }
        }
        if ($request->has('lang') && $request->input('lang') == 'eng') {
            $repository = new OfficeRepository(EngOffice::class);
        } else {
            $repository = new OfficeRepository(Office::class);
        }

        $offices = $repository->find($coordinates[1], $coordinates[0], $coordinates[3],
            $coordinates[2]);

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
                ->select('id', 'site_id', 'url', 'path', 'name', 'is_download', 'updated_at')
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

        $headers = [
            'Content-Type' => $imageResponse->getMimeTypeByUrl($image->url),
            'ETag' => $hash,
        ];
        if ($image->is_download) {
            $headers['Content-Disposition'] = 'attachment; filename=' . $image->name . ';';
        }

        return response()->file(
            $imageResponse->getPath(), $headers
        );
    }

    public function city(Request $request)
    {
        $client = new Client();
        $response = $client->request(
            'POST', 'http://production.locality.service.cdek.tech:8909/api/locality/international/autocomplete/city',
            [
                'headers' => ['Content-Type', 'application/json', 'X-User-Lang' => $request->input('lang')],
                'json' => ['limit' => 5, 'query' => $request->input('query')],
            ]
        );
        return $response->getBody();
    }
}