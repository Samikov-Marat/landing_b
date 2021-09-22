<?php

namespace App\Http\Controllers\site;

use App\Classes\DictionaryBuilder;
use App\Classes\Domain;
use App\Classes\FragmentRepository;
use App\Classes\LanguageDetector;
use App\Classes\SiteRepository;
use App\Exceptions\CurrentPageNotFound;
use App\Exceptions\PageController\LanguageListIsEmpty;
use App\Exceptions\PageController\SiteNotFound;
use App\Http\Controllers\Controller;
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
                ->chooseFrom($site->languages);
            $languageShortName = Str::lower($language->shortname);
            return response()->redirectToRoute('site.show_page', ['languageUrl' => $languageShortName]);
        } catch (SiteNotFound $e) {
            abort(Response::HTTP_NOT_FOUND);
        } catch (LanguageListIsEmpty $e) {
            abort(Response::HTTP_NOT_FOUND);
        }
    }


    public function showPage(Request $request, $languageUrl, $pageUrl = '/')
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

        return view('site.' . $page->template)
            ->with('site', $siteRepository->getSite())
            ->with('language', $language)
            ->with('page', $page)
            ->with('dictionary', $dictionary)
            ->with('pageUrl', $pageUrl);
    }
}
