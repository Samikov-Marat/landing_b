<?php

namespace App\Http\Controllers\site;

use App\Classes\DictionaryBuilder;
use App\Classes\Domain;
use App\Classes\FragmentRepository;
use App\Classes\LanguageDetector;
use App\Classes\Site\AllowCookie;
use App\Classes\Site\CustomRouting;
use App\Classes\Site\RequestCleaner;
use App\Classes\Site\SupportContainer;
use App\Classes\Site\TemplateBuilder;
use App\Classes\SiteRepository;
use App\Exceptions\CurrentPageNotFound;
use App\Exceptions\PageController\LanguageListIsEmpty;
use App\Exceptions\PageController\SiteNotFound;
use App\Http\Controllers\Controller;
use App\SupportCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function selectDefaultLanguage(Request $request)
    {
        try {
            $domain = Domain::getInstance($request)
                ->get();
            $siteRepository = new SiteRepository($domain);
            $site = $siteRepository->getSite();
            $language = LanguageDetector::getInstance($request->server('HTTP_ACCEPT_LANGUAGE', ''))
                ->chooseFrom(
                    $site->languages->filter(function ($language, $key) {
                        return !$language->disabled;
                    })
                );
            $languageShortName = Str::lower($language->shortname);
            $requestCleaner = new RequestCleaner($request);
            $params = array_merge(['languageUrl' => $languageShortName], $requestCleaner->getCleared());
            return response()->redirectToRoute('site.show_page', $params);
        } catch (SiteNotFound $e) {
            abort(Response::HTTP_NOT_FOUND);
        } catch (LanguageListIsEmpty $e) {
            abort(Response::HTTP_NOT_FOUND);
        }
    }


    public function showPage(Request $request, $languageUrl, $pageUrl = '/', $category = null, $question = null)
    {
        $domain = Domain::getInstance($request)->get();
        try {
            $siteRepository = new SiteRepository($domain);
        } catch (ModelNotFoundException $exception) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $languageShortname = Str::upper($languageUrl);
        if (!$siteRepository->containsLanguage($languageShortname)) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $language = $siteRepository->getLanguage($languageShortname);
        if ($language->disabled) {
            $requestCleaner = new RequestCleaner($request);
            return response()->redirectToRoute('site.select_default_language', $requestCleaner->getCleared());
        }


        try {
            $page = $siteRepository->getCurrentPage($pageUrl);
        } catch (CurrentPageNotFound $e) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $fragments = $siteRepository->getLayoutFragments();
        $fragments->push($page);
        $fragmentRepository = new FragmentRepository($fragments);
        $dictionary = DictionaryBuilder::get($fragmentRepository->getWithTexts($language));
        $siteRepository->loadLocalOffices($language);
        $siteRepository->loadNewsArticles($language);
        $siteRepository->loadOurWorkers($language);
        $siteRepository->loadFeedbacks($language);
        $topOffices = $siteRepository->getTopOffices($language);

        $customRouting = CustomRouting::getInstance($request);

        $supportContainer = new SupportContainer($siteRepository->getSite(), $language, $category, $question);
        if ($customRouting->isSupportPage()) {
            $supportContainer->prepare();
        }

        $templateBuilder = new TemplateBuilder();
        if ($customRouting->isSupportPage() && isset($category) && isset($question)) {
            $templateBuilder->setSupportAnswer();
        } elseif ($customRouting->isSupportPage() && isset($category)) {
            $templateBuilder->setSupportCategory();
        } else {
            $templateBuilder->setNormalTemplate($page->template);
        }

        return view($templateBuilder->getName())
            ->with('site', $siteRepository->getSite())
            ->with('supportContainer', $supportContainer)
            ->with('language', $language)
            ->with('page', $page)
            ->with('dictionary', $dictionary)
            ->with('pageUrl', $pageUrl)
            ->with('topOffices', $topOffices)
            ->with('allowCookies', AllowCookie::getInstance($request)->isAllow());
    }
}
