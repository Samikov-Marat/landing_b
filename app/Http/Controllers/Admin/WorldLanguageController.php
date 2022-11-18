<?php

namespace App\Http\Controllers\Admin;

use App\Classes\LanguageIsoSearcher;
use App\Http\Controllers\Controller;
use App\WorldLanguage;
use Illuminate\Http\Request;

class WorldLanguageController extends Controller
{
    const SORT_STEP = 10;

    public function index()
    {
        $worldLanguages = WorldLanguage::select('id', 'language_code_iso', 'name')
            ->orderBy('sort')
            ->with('languageIso')
            ->get();

        return view('admin.world_languages.index')
            ->with('worldLanguages', $worldLanguages);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $worldLanguage = WorldLanguage::select('id', 'language_code_iso', 'name')
                ->find($id);
        } else {
            $worldLanguage = null;
        }

        return view('admin.world_languages.form')
            ->with('worldLanguage', $worldLanguage);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $worldLanguage = WorldLanguage::find($request->input('id'));
        } else {
            $worldLanguage = new WorldLanguage();
        }
        $worldLanguage->language_code_iso = $request->input('language_code_iso');
        $worldLanguage->name = $request->input('name');
        if (!$isEditMode) {
            $worldLanguage->sort = WorldLanguage::max('sort') + self::SORT_STEP;
        }

        $worldLanguage->save();

        return response()->redirectToRoute('admin.world_languages.index');
    }

    public function delete(Request $request)
    {
        $worldLanguage = WorldLanguage::find($request->input('id'));
        $worldLanguage->delete();
        return response()->redirectToRoute('admin.world_languages.index');
    }

    public function move(Request $request)
    {
        $worldLanguage = WorldLanguage::find($request->input('id'));

        $direction = $request->input('direction');
        if ('up' == $direction) {
            $sign = '<';
            $orderByDirection = 'desc';
        }
        if ('down' == $direction) {
            $sign = '>';
            $orderByDirection = 'asc';
        }
        $otherWorldLanguage = WorldLanguage::select('id', 'sort')
            ->where('sort', $sign, $worldLanguage->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $worldLanguage->sort;
        $worldLanguage->sort = $otherWorldLanguage->sort;
        $worldLanguage->save();
        $otherWorldLanguage->sort = $sort;
        $otherWorldLanguage->save();

        return response()->redirectToRoute('admin.world_languages.index');
    }

    public function searchIso(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = LanguageIsoSearcher::getInstance()->search($term, $page);
        return response()->json($languageIsoSearchResult->asArray());
    }

}
