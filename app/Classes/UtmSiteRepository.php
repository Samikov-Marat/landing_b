<?php


namespace App\Classes;

use App\Exceptions\LocalOfficeNotFoundByUtm;
use App\Site;

class UtmSiteRepository
{

    private $site;

    public function __construct(string $domain)
    {
        $this->site = Site::where('domain', $domain)
            ->with(
                [
                    'localOffices' => function ($query) {
                        $query->select(
                            ['id', 'site_id', 'utm_tag', 'utm_value', 'category', 'request_timezone', 'subdomain',]
                        )
                            ->orderBy('sort');
                    }
                ]
            )
            ->firstOrFail();
    }

    public function getTags(): array
    {
        $tags = [];
        foreach ($this->site->localOffices as $localOffice) {
            $tags[] = $localOffice->utm_tag;
        }
        return array_unique($tags);
    }

    public function getLocalOffice(array $utms)
    {
        foreach ($this->site->localOffices as $localOffice) {
            if (isset($utms['subdomain']) &&
                ($localOffice->subdomain == $utms['subdomain'])) {
                return $localOffice;
            }
        }
        foreach ($this->site->localOffices as $localOffice) {
            if (isset($utms[$localOffice->utm_tag]) &&
                ($localOffice->utm_value == $utms[$localOffice->utm_tag])) {
                return $localOffice;
            }
        }
        throw new LocalOfficeNotFoundByUtm('Офис по subdomain и utm в cookies не найден');
    }

    public function getLocalOfficeWithoutCookies($subdomain)
    {
        foreach ($this->site->localOffices as $localOffice) {
            if ($localOffice->subdomain == $subdomain) {
                return $localOffice;
            }
        }
        throw new LocalOfficeNotFoundByUtm('Офис по subdomain без cookies не найден');
    }

    public function getSite()
    {
        return $this->site;
    }

}
