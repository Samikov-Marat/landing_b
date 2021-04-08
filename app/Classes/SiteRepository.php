<?php


namespace App\Classes;

use App\Exceptions\CurrentPageNotFound;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Boolean;

class SiteRepository
{
    var $site;

    public function __construct($domain)
    {
        $this->site = Site::where('domain', $domain)
            ->with(
                [
                    'languages' => function ($query) {
                        $query->select('id', 'site_id', 'shortname', 'name')
                            ->orderBy('sort');
                    }
                ]
            )
            ->firstOrFail();
    }

    public function containsLanguage($languageShortname): bool
    {
        return $this->site->languages->contains('shortname', $languageShortname);
    }

    public function getLanguage($languageShortname): Language
    {
        return $this->site->languages->firstWhere('shortname', $languageShortname);
    }

    public function getCurrentPage($pageUrl): Page
    {
        $this->loadPages($pageUrl);

        if ($this->site->pages->isEmpty()) {
            throw new CurrentPageNotFound();
        }
        return $this->site->pages->first();
    }

    public function getLayoutFragments(): Collection
    {
        return $this->site->pages()->where('is_layout', true)
            ->get();
    }

    public function getSite(): Site
    {
        return $this->site;
    }

    private function loadPages($pageUrl)
    {
        $this->site->load(
            [
                'pages' => function ($query) use ($pageUrl) {
                    $query->where('url', $pageUrl);
                }
            ]
        );
    }

    public function loadLocalOffices($laguage){
        $language_id = $laguage->id;
        $this->site->load(
            [
                'localOffices' => function ($query) use ($language_id) {
                    $query->select('id', 'site_id')
                        ->orderBy('sort');
                },
                'localOffices.localOfficeTexts' => function ($query) use ($language_id) {
                    $query->where('language_id', $language_id);
                },
                'localOffices.localOfficePhones' => function ($query) {
                    $query->orderBy('sort');
                },
                'localOffices.localOfficeEmails' => function ($query) {
                    $query->orderBy('sort');
                },
            ]
        );
    }
}
