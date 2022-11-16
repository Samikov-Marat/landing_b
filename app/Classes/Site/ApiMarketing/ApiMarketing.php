<?php

namespace App\Classes\Site\ApiMarketing;

use App\Classes\CategoryInTurn;
use App\Classes\Domain;
use App\Classes\UtmCookie;
use App\Classes\UtmSiteRepository;
use App\Exceptions\LocalOfficeNotFoundByUtm;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class ApiMarketing
{
    private $request;
    private $domain;
    private $apiMarketingCategory = '';
    private $timezone = '0';


    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->domain = Domain::getInstance($this->request);
        $this->prepareCategoryAndTimezone($this->domain);
    }

    public static function getInstance(Request $request): self
    {
        return new static($request);
    }

    public function sendCalculatorRequest()
    {
        $apiMarketingRequestCalculator = new ApiMarketingRequestCalculator(
            $this->request,
            $this->domain,
            $this->apiMarketingCategory,
            $this->timezone
        );
        return ApiMarketingSender::send($apiMarketingRequestCalculator->get());
    }

    public function sendFeedbackRequest()
    {
        $apiMarketingRequestFeedback = new ApiMarketingRequestFeedback(
            $this->request,
            $this->domain,
            $this->apiMarketingCategory,
            $this->timezone
        );
        return ApiMarketingSender::send($apiMarketingRequestFeedback->get());
    }

    public function sendOrderRequest()
    {
        $apiMarketingRequestOrder = new ApiMarketingRequestOrder(
            $this->request,
            $this->domain,
            $this->apiMarketingCategory,
            $this->timezone
        );
        return ApiMarketingSender::send($apiMarketingRequestOrder->get());
    }

    public function sendPresentationRequest()
    {
        $apiMarketingRequestPresentation = new ApiMarketingRequestPresentation(
            $this->request,
            $this->domain,
            $this->apiMarketingCategory,
            $this->timezone
        );
        return ApiMarketingSender::send($apiMarketingRequestPresentation->get());
    }


    public function prepareCategoryAndTimezone(Domain $domain)
    {
        try {
            $localOfficeRepository = new UtmSiteRepository($domain->get());
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
            return;
        }

        if($domain->hasSubdomain()){
            $localOffice = $localOfficeRepository->getLocalOfficeWithoutCookies($domain->getSubdomain());
            $this->apiMarketingCategory = $localOffice->category;
            $this->timezone = $localOffice->request_timezone;
            return;
        }

        $old = Cookie::get(UtmCookie::COOKIE_NAME);
        if (!is_null($old)) {
            try {
                $oldUtmCookie = UtmCookie::getInstanceFromJson($old);
                $localOffice = $localOfficeRepository->getLocalOffice($oldUtmCookie->getData());
                $this->apiMarketingCategory = $localOffice->category;
                $this->timezone = $localOffice->request_timezone;
                return;
            } catch (LocalOfficeNotFoundByUtm $e) {
                Log::debug($e->getMessage());
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
        try {
            $localOffice = CategoryInTurn::getInstance($localOfficeRepository->getSite()->localOffices)
                ->getNextNew();
            $this->apiMarketingCategory = $localOffice->category;
            $this->timezone = $localOffice->request_timezone;
            return;
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
