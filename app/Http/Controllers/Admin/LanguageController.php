<?php

namespace App\Http\Controllers\Admin;

use App\Classes\LanguageIsoSearcher;
use App\Http\Controllers\Controller;
use App\Language;
use App\Site;
use App\WorldLanguage;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with(
                [
                    'languages' => function ($query) {
                        $query->select(['id', 'site_id', 'shortname', 'name', 'rtl', 'sort', 'world_language_id', 'disabled'])
                            ->orderBy('sort');
                    },
                ]
            )
            ->with('languages.worldLanguage')
            ->find($request->input('site_id'));
        return view('admin.languages.index')
            ->with('site', $site);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $language = Language::select(
                ['id', 'shortname', 'language_code_iso', 'name', 'site_id', 'rtl', 'world_language_id', 'disabled']
            )
                ->with('languageIso')
                ->with('worldLanguage')
                ->find($id);
            $siteId = $language->site_id;
        } else {
            $language = null;
            $siteId = $request->input('site_id');
        }
        $site = Site::select('id', 'name', 'domain')
            ->find($siteId);
        $worldLanguages = WorldLanguage::select(['id', 'name',])
            ->orderBy('sort')
            ->get();

        return view('admin.languages.form')
            ->with('site', $site)
            ->with('worldLanguages', $worldLanguages)
            ->with('language', $language);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $language = Language::find($request->input('id'));
        } else {
            $language = new Language();
        }

        $language->site_id = $request->input('site_id');
        $language->shortname = $request->input('shortname');
        $language->language_code_iso = $request->input('language_code_iso');
        $language->name = $request->input('name');
        $language->rtl = $request->input('rtl', false);
        $language->disabled = $request->input('disabled', false);

        if ($request->input('world_language_id') === '') {
            $language->world_language_id = null;
        } elseif ($request->has('world_language_id')) {
            $language->world_language_id = $request->input('world_language_id');
        }

        if (!$isEditMode) {
            $language->sort = Language::where('site_id', $language->site_id)->max('sort') + self::SORT_STEP;
        }

        $language->save();

        return response()->redirectToRoute('admin.languages.index', ['site_id' => $language->site_id]);
    }

    public function delete(Request $request)
    {
        $language = Language::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $language->site_id;
        $language->delete();
        return response()->redirectToRoute('admin.languages.index', ['site_id' => $site_id]);
    }

    public function move(Request $request)
    {
        $language = Language::select('id', 'site_id', 'sort')
            ->find($request->input('id'));

        $direction = $request->input('direction');
        if ('up' == $direction) {
            $sign = '<';
            $orderByDirection = 'desc';
        }
        if ('down' == $direction) {
            $sign = '>';
            $orderByDirection = 'asc';
        }
        $otherLanguage = Language::select('id', 'sort')
            ->where('site_id', $language->site_id)
            ->where('sort', $sign, $language->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $language->sort;
        $language->sort = $otherLanguage->sort;
        $language->save();
        $otherLanguage->sort = $sort;
        $otherLanguage->save();

        return response()->redirectToRoute('admin.languages.index', ['site_id' => $language->site_id]);
    }

    public function searchIso(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = LanguageIsoSearcher::getInstance()->search($term, $page);
        \Debugbar::disable();
        return response()->json($languageIsoSearchResult->asArray());
    }

}
