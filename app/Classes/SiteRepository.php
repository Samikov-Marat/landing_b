<?php


namespace App\Classes;

use App\Exceptions\CurrentPageNotFound;
use App\Exceptions\PageController\LanguageListIsEmpty;
use App\Exceptions\PageController\SiteNotFound;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use phpDocumentor\Reflection\Types\Boolean;

class SiteRepository
{
    var $site;
    var $newsLimit = 4;
    var $ourWorkersLimit = 3;

    public function __construct($domain)
    {
        try {
            $this->site = Site::where('domain', $domain)
                ->with(
                    [
                        'languages' => function ($query) {
                            $query->select('id', 'site_id', 'shortname', 'rtl', 'name', 'language_code_iso')
                                ->orderBy('sort');
                        }
                    ]
                )
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new SiteNotFound('Сайт не найден', 0, $e);
        }
    }

    public function getSite(): Site
    {
        $this->loadLanguages();

        return $this->site;
    }

    public function loadLanguages()
    {
        $this->site->load(
            [
                'languages' => function ($query) {
                    $query->select('id', 'site_id', 'shortname', 'rtl', 'name', 'language_code_iso')
                        ->orderBy('sort');
                }
            ]
        );
        if ($this->site->languages->isEmpty()) {
            throw new LanguageListIsEmpty('Не найдена ни одного языка у этого сайта');
        }
    }

    public function loadNewsArticles($language)
    {
        $newsLimit = $this->newsLimit;
        $this->site->load(
            [
                'newsArticles' => function ($query) use ($language, $newsLimit) {
                    $query->select(
                        ['id', 'site_id', 'publication_date_text', 'header', 'note', 'text', 'preview', 'image']
                    )
                        ->orderBy('publication_date', 'desc')
                        ->where('language_id', $language->id)
                        ->limit($newsLimit);
                }
            ]
        );
    }

    public function loadOurWorkers($language)
    {
        $ourWorkersLimit = $this->ourWorkersLimit;
        $this->site->load(
            [
                'ourWorkers' => function ($query) use ($ourWorkersLimit) {
                    $query->select(['id', 'site_id', 'photo'])
                        ->orderBy('sort')
                        ->limit($ourWorkersLimit);
                },
                'ourWorkers.ourWorkerTexts' => function ($query) use ($language) {
                    $query->select(['id', 'our_worker_id', 'name', 'post'])
                        ->where('language_id', $language->id);
                }
            ]
        );
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

    public function loadLocalOffices($language)
    {
        $language_id = $language->id;
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
                'localOffices.localOfficePhotos' => function ($query) {
                    $query->select(['id', 'local_office_id',
                                       'sample', 'sample2',
                                       'mobile', 'mobile2',
                                       'tablet', 'tablet2',
                                       ])
                        ->orderBy('sort');
                },
            ]
        );
    }
}
