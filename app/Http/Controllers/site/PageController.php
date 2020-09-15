<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function selectDefaultLanguage(Request $request)
    {
        $domain = $request->server('HTTP_HOST');

        try {
            $site = Site::where('domain', $domain)
                ->with(
                    [
                        'languages' => function ($query) {
                            $query->select('id', 'site_id', 'shortname')
                                ->orderBy('sort');
                        }
                    ]
                )
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(Response::HTTP_NOT_FOUND);
        }

        if ($site->languages->isEmpty()) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $languageShortName = Str::lower($site->languages->first()->shortname);
        return response()->redirectToRoute('site.show_page', ['languageUrl' => $languageShortName]);
    }


    public function showPage(Request $request, $languageUrl, $pageUrl = '/')
    {
        $domain = $request->server('HTTP_HOST');

        try {
            $site = Site::where('domain', $domain)
                ->with(
                    [
                        'languages' => function ($query) {
                            $query->select('id', 'site_id', 'shortname', 'name')
                                ->orderBy('sort');
                        }
                    ]
                )
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $languageShortname = Str::upper($languageUrl);

        if (!$site->languages->contains('shortname', $languageShortname)) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $language = $site->languages->firstWhere('shortname', $languageShortname);

        $site->load(
            [
                'pages' => function ($query) use ($pageUrl) {
                    $query->where('url', $pageUrl);
                }

            ]
        );

        if ($site->pages->isEmpty()) {
            abort(Response::HTTP_NOT_FOUND);
        }
        $page = $site->pages->first();

        $page->load(
            [
                'textTypes' => function ($query) {
                    $query->select('id', 'page_id', 'shortname');
                }
            ]
        )->load(
            [
                'textTypes.texts' => function ($query) use ($language) {
                    $query->select('id', 'text_type_id', 'value')
                        ->where('language_id', $language->id);
                }
            ]
        );

        $dictionary = $page->textTypes->pluck('texts', 'shortname');

        dd($dictionary);

        return view('site.' . $page->template)
            ->with('site', $site)
            ->with('language', $language)
            ->with('page', $page);
    }
}
