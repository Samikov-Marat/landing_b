<?php


namespace App\Classes;

use App\Classes\Site\Subdomain;
use App\Classes\Site\TopOfficeRepository;
use App\Exceptions\CurrentPageNotFound;
use App\Exceptions\PageController\LanguageListIsEmpty;
use App\Exceptions\PageController\SiteNotFound;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;


class SiteRepository
{
    private $site;
    private $newsLimit = 4;
    private $ourWorkersLimit = 3;
    private $feedbacksLimit = 10;

    public function __construct(Domain $domain)
    {
        try {
            $this->site = Site::where('domain', $domain->get())
                ->with(
                    [
                        'languages' => function ($query) {
                            $query->select(
                                [
                                    'id',
                                    'site_id',
                                    'shortname',
                                    'rtl',
                                    'name',
                                    'language_code_iso',
                                    'world_language_id',
                                    'disabled',
                                ]
                            )->orderBy('sort');
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
                    $query->select('id', 'site_id', 'shortname', 'rtl', 'name', 'language_code_iso', 'disabled')
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
        $this->site->load(
            [
                'newsArticles.newsArticleTexts' => function ($query) use ($language) {
                    $query->select(['id', 'news_article_id', 'publication_date_text', 'header', 'note', 'text'])
                        ->where('language_id', $language->id);
                },
                'newsArticles' => function ($query) {
                    $query->select(['id', 'site_id', 'preview', 'image', 'image2', 'mobile', 'mobile2'])
                        ->orderBy('publication_date', 'desc');
                },
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

    public function loadFeedbacks($language)
    {
        $feedbacksLimit = $this->feedbacksLimit;
        $language_id = $language->id;
        $this->site->load(
            [
                'feedbacks' => function ($query) use ($feedbacksLimit, $language_id) {
                    $query->select(['id', 'site_id', 'language_id', 'name', 'email', 'text'])
                        ->where('language_id', $language_id)
                        ->where('published', 1)
                        ->orderBy('writing_date', 'desc')
                        ->limit($feedbacksLimit);
                }
            ]
        );
    }

    public function getTopOffices($language)
    {
        return TopOfficeRepository::getInstance()->getList($language);
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

    public function loadTariffs($language)
    {
        if ('ru' == $language->language_code_iso) {
            $preferredLanguage = 'rus';
        } elseif ('en' == $language->language_code_iso) {
            $preferredLanguage = 'eng';
        } elseif ('tr' == $language->language_code_iso) {
            $preferredLanguage = 'tur';
        } elseif ('zh' == $language->language_code_iso) {
            $preferredLanguage = 'zho';
        } else {
            $preferredLanguage = 'eng';
        }

        $this->site->load(
            [
                'tariffs.tariffTexts' => function ($query) use ($preferredLanguage) {
                    $query->orderBy(DB::raw('language_code_iso <> ' . $preferredLanguage))
                        ->orderBy(DB::raw('language_code_iso <> "eng"'));
                },
                'tariffs.tariffType.tariffTypeTexts' => function ($query) use ($preferredLanguage) {
                    $query->orderBy(DB::raw('language_code_iso <> ' . $preferredLanguage))
                        ->orderBy(DB::raw('language_code_iso <> "eng"'));
                }
            ]
        );
    }

    public function loadLocalOffices($language, Subdomain $subdomain)
    {
        $sameFranchiseeLocalOffices = $subdomain->getFranchisee()->localOffices;

        $this->site->load(
            [
                'localOffices' => function ($query) use ($subdomain, $sameFranchiseeLocalOffices) {
                    $query->select('id', 'site_id', 'map_preset')
                        ->where('disabled', false)
                        ->orderBy('sort');
                    if ($subdomain->hasSubdomain()) {
                        $query->whereIn('id', $sameFranchiseeLocalOffices->pluck('id'));
                    }

                },
                'localOffices.localOfficeTexts' => function ($query) use ($language) {
                    $query->where('language_id', $language->id);
                },
                'localOffices.localOfficePhones' => function ($query) {
                    $query->orderBy('sort');
                },
                'localOffices.localOfficeEmails' => function ($query) {
                    $query->orderBy('sort');
                },
                'localOffices.localOfficePhotos' => function ($query) {
                    $query->select([
                                       'id',
                                       'local_office_id',
                                       'sample',
                                       'sample2',
                                       'mobile',
                                       'mobile2',
                                       'tablet',
                                       'tablet2',
                                   ])
                        ->orderBy('sort');
                },
            ]
        );
    }

    private function getSameFranchiseeLocalOffices($subdomain): Collection
    {
        if (!$subdomain->hasSubdomain()) {
            return new Collection();
        }

        $domainLocalOffice = $subdomain->getLocalOffice();
        if (is_null($domainLocalOffice->franchisee)) {
            return new Collection();
        }

        $domainLocalOffice->load('franchisee.localOffices');
        return $domainLocalOffice->franchisee->localOffices;
    }
}
