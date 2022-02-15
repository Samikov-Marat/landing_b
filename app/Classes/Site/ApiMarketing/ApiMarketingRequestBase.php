<?php

namespace App\Classes\Site\ApiMarketing;

use Illuminate\Support\Carbon;

class ApiMarketingRequestBase
{
    var $request;
    var $domain;
    var $apiMarketingCategory = '';
    var $receiverTimezone;

    function __construct($request, $domain, $apiMarketingCategory, $receiverTimezone)
    {
        $this->request = $request;
        $this->domain = $domain;
        $this->apiMarketingCategory = $apiMarketingCategory;
        $this->receiverTimezone = $receiverTimezone;
    }

    protected function input($key, $default = '')
    {
        return $this->request->input($key, $default);
    }

    protected function getRequestDatetime()
    {
        return Carbon::now()
            ->setTimezone($this->receiverTimezone)
            ->format('d M Y H:i:s  (e)');
    }

}
