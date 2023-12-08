<?php

namespace App\Http\Controllers\Site;

use App\Classes\Domain;
use App\Classes\EmailNotification\EmailNotificationForward;
use App\Classes\EmailNotification\EmailNotificationShopping;
use App\Classes\ImageResponse;
use App\Classes\MapJsonCallback;
use App\Classes\OfficeRepository;
use App\Classes\Site\AllowCookie;
use App\Classes\Site\Amo\AmoCRMApiClientBuilder;
use App\Classes\Site\Amo\AmoCRMApiClientVelocity;
use App\Classes\Site\Amo\AmoFormFranchise;
use App\Classes\Site\Amo\AmoFormVelocity;
use App\Classes\Site\Amo\AmoSender;
use App\Classes\Site\Amo\AmoSenderVelocity;
use App\Classes\Site\ApiMarketing\ApiMarketing;
use App\Classes\Site\Calculator;
use App\Classes\Site\CalculatorJson\CalculatorJsonGenerator;
use App\Classes\Site\CalculatorResponse;
use App\Classes\Site\CountryByCityUuid;
use App\Classes\Site\FormRequestRepository;
use App\Classes\Site\Jira\JiraSender;

use App\Classes\Site\ReferralCookiesHelper;
use App\Classes\Site\SupportEmail;
use App\EngOffice;
use App\Facades\Metrics;
use App\Feedback;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalculatorRequest;
use App\Language;
use App\Office;
use App\Site;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class RequestController extends Controller
{

    public function send(Request $request)
    {
        try {
            FormRequestRepository::getInstance('send')
                ->save($request);
            ApiMarketing::getInstance($request)->sendCalculatorRequest();
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }

    public function feedback(Request $request): Response
    {
        try {
            FormRequestRepository::getInstance('feedback')
                ->save($request);
            ApiMarketing::getInstance($request)->sendFeedbackRequest();
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }

    public function support(Request $request)
    {
        try {
            FormRequestRepository::getInstance('support')
                ->save($request);
            if ('delivery' == $request->input('order_type')) {
                JiraSender::send($request);
            } elseif ('shopping' == $request->input('order_type')) {
                $htmlContent = view('site.universal2.support_mail_shopping')
                    ->with('request', $request)
                    ->with('currentTime', date('d.m.Y H:i:s'))
                    ->render();
                EmailNotificationShopping::getInstance()
                    ->setHtmlContent($htmlContent)
                    ->send();
            } elseif ('forward' == $request->input('order_type')) {
                $htmlContent = view('site.universal2.support_mail_forward')
                    ->with('request', $request)
                    ->with('currentTime', date('d.m.Y H:i:s'))
                    ->render();
                EmailNotificationForward::getInstance()
                    ->setHtmlContent($htmlContent)
                    ->send();
            }
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }

    public function franchise(Request $request)
    {
        try {
            FormRequestRepository::getInstance('franchise')
                ->save($request);

            $client = AmoCRMApiClientBuilder::getInstance()->getClient();
            $siteId = $request->input('site_id');
            AmoSender::getInstance($client, $siteId)
                ->send($request->input('url'), AmoFormFranchise::get($request));
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }

    public function velocity(Request $request)
    {
        try {
            $client = app(AmoCRMApiClientVelocity::class)->getClient();
            app(AmoSenderVelocity::class)
                ->setApiClient($client)
                ->send(AmoFormVelocity::get($request));
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response('');
    }

    public function order(Request $request): Response
    {
        try {
            FormRequestRepository::getInstance('order')
                ->save($request);
            ApiMarketing::getInstance($request)->sendOrderRequest();
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }

    public function presentation(Request $request)
    {
        try {
            FormRequestRepository::getInstance('presentation')
                ->save($request);

            ApiMarketing::getInstance($request)->sendPresentationRequest();
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }

    public function allowCookies(Request $request)
    {
        AllowCookie::getInstance($request)
            ->setAllow();
        ReferralCookiesHelper::getInstance()
            ->setForce(true)
            ->save($request);
        if ($request->input('preferred_response', 'html') === 'redirect') {
            return view('site.universal2.gtm_block');
        }
        return response()
            ->redirectTo($request->input('url'), HttpFoundationResponse::HTTP_FOUND);
    }

    public function feedbackReview(Request $request)
    {
        $domain = app(Domain::class)->get();
        try {
            FormRequestRepository::getInstance('feedbackReview')
                ->save($request);

            $site = Site::where('domain', $domain)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            Log::error($exception);
            abort(HttpFoundationResponse::HTTP_NOT_FOUND);
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

            response('saved', 200)
                ->header('Content-Type', 'text/plain');
        } catch (Exception $e) {
            Log::error($e);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
        return response()->noContent();
    }

    public function getOfficeList(Request $request)
    {
        $coordinates = explode(',', $request->input('bbox'));
        foreach ($coordinates as $value) {
            if (!is_numeric($value)) {
                Log::error(
                    'Формат координат в запросе неверный. Не число в одной из координат' .
                    var_export($value, true)
                );
                abort(HttpFoundationResponse::HTTP_BAD_REQUEST);
            }
        }
        if ($request->has('lang') && $request->input('lang') == 'eng') {
            $repository = new OfficeRepository(EngOffice::class);
        } else {
            $repository = new OfficeRepository(Office::class);
        }

        $offices = $repository->find(
            $coordinates[1],
            $coordinates[0],
            $coordinates[3],
            $coordinates[2]
        );

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
        $domain = app(Domain::class)->get();
        try {
            $site = Site::where('domain', $domain)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(HttpFoundationResponse::HTTP_NOT_FOUND);
        }
        try {
            $image = $site->images()
                ->select('id', 'site_id', 'url', 'path', 'name', 'is_download', 'updated_at')
                ->where('url', '/' . $imageUrl)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            Log::error(new Exception('Не найдена ' . $imageUrl));
            abort(HttpFoundationResponse::HTTP_NOT_FOUND);
        }
        $imageResponse = ImageResponse::getInstance()->setPath($image->path);
        $hash = $image->updated_at->format('Y-m-d H:i:s');
        if ($request->header('If-None-Match') == $hash) {
            abort(HttpFoundationResponse::HTTP_NOT_MODIFIED);
        }

        $headers = [
            'Content-Type' => $imageResponse->getMimeTypeByUrl($image->url),
            'ETag' => $hash,
        ];
        if ($image->is_download) {
            $headers['Content-Disposition'] = 'attachment; filename=' . $image->name . ';';
        }

        return response()->file(
            $imageResponse->getPath(),
            $headers
        );
    }

    public function city(Request $request)
    {
        $client = new Client();
        $response = $client->request(
            'POST', config('calculator.city_url'),
            [
                'headers' => [
                    'Content-Type',
                    'application/json',
                    'X-User-Lang' => $request->input('lang'),
                ],
                'json' => [
                    'limit' => 5,
                    'query' => $request->input('query'),
                    'offset' => 0,
                    'defaultLang' => 'eng'
                ],
            ]
        );
        return $response->getBody();
    }

    public function calculate(
        CalculatorRequest       $request,
        Calculator              $calculator,
        CalculatorJsonGenerator $calculatorJsonGenerator,
        CalculatorResponse $calculatorResponse,
        CountryByCityUuid $countryByCityUuid
    ) {
        $countryCode = $countryByCityUuid->get($request->input('sender_city_uuid'));
        if ($countryCode === 'RU') {
            return response()->json([
                'handle' => 'redirect'
            ]);
        }
        try {
            // B2B, B2C
            $clientsType = ($request->customer_type ?? 'B') . 2 . ($request->receiver_type ?? 'C');
            $responseBody = $calculator->getTariffs(
                $request,
                $calculatorJsonGenerator,
                config('calculator.url')
            );

            return $calculatorResponse->transformResponseBody(
                $responseBody,
                $request->language,
                $clientsType,
                $request->page
            );
        } catch (Exception $exception) {
            Log::error($exception);
            abort(HttpFoundationResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function exposeMetrics()
    {
        return response(
            Metrics::render(),
            HttpFoundationResponse::HTTP_OK,
            ['Content-type' => Metrics::getMimeType()]
        );
    }

}
