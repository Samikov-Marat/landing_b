<?php

namespace App\Classes\Site\ApiMarketing;

use App\Classes\ApiMarketing;
use App\Classes\CategoryInTurn;
use App\Classes\Domain;
use App\Classes\UtmCookie;
use App\Classes\UtmSiteRepository;
use App\Exceptions\LocalOfficeNotFoundByUtm;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;

class NewApiMarketingNew
{
    private $request;
    private $domain;
    private $apiMarketingCategory = '';
    private $timezone = '0';


    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->domain = Domain::getInstance($this->request)->get();
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
        return ApiMarketing::send($apiMarketingRequestCalculator->get());
    }


    public function prepareCategoryAndTimezone($domain)
    {
        try {
            $localOfficeRepository = new UtmSiteRepository($domain);
        } catch (ModelNotFoundException $exception) {
            Log::error($exception->getMessage());
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
            $localOffice = CategoryInTurn::getInstance($localOfficeRepository->site->localOffices)
                ->getNextNew();
            $this->apiMarketingCategory = $localOffice->category;
            $this->timezone = $localOffice->request_timezone;
            return;
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
