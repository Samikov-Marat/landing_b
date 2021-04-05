<?php


namespace App\Classes;

use App\Exceptions\LocalOfficeNotFoundByUtm;
use App\Site;

class UtmSiteRepository
{

    var $site;

    public function __construct($domain)
    {
        $this->site = Site::where('domain', $domain)
            ->with(
                [
                    'localOffices' => function ($query) {
                        $query->select('id', 'site_id', 'utm_tag', 'utm_value', 'category')
                            ->orderBy('sort');
                    }
                ]
            )
            ->firstOrFail();
    }

    public function getTags()
    {
        $tags = [];
        foreach ($this->site->localOffices as $localOffice) {
            $tags[] = $localOffice->utm_tag;
        }
        return array_unique($tags);
    }

    public function getCategory($utms)
    {
        foreach ($this->site->localOffices as $localOffice) {
            if (isset($utms[$localOffice->utm_tag]) &&
                ($localOffice->utm_value == $utms[$localOffice->utm_tag])) {
                return $localOffice->category;
            }
            throw new LocalOfficeNotFoundByUtm('Офис по utm в cookies не найден');
        }
    }

}
