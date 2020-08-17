<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Language;
use App\Site;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with('languages:id,site_id,shortname,name,sort')
            ->find($request->input('site_id'));
        return view('admin.languages.index')
            ->with('site', $site);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $language = Language::select('id', 'shortname', 'name', 'site_id')
                ->find($id);
            $site = Site::select('id', 'name', 'domain')
                ->find($language->site_id);
        } else {
            $language = null;
            $site = Site::select('id', 'name', 'domain')
                ->find($request->input('site_id'));
        }


        return view('admin.languages.form')
            ->with('site', $site)
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
        $language->name = $request->input('name');

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
        }
        if ('down' == $direction) {
            $sign = '>';
        }
        $otherLanguage = Language::select('id', 'sort')
            ->where('site_id', $language->site_id)
            ->where('sort', $sign, $language->sort)
            ->first();

        $sort = $language->sort;
        $language->sort = $otherLanguage->sort;
        $language->save();
        $otherLanguage->sort = $sort;
        $otherLanguage->save();

        return response()->redirectToRoute('admin.languages.index', ['site_id' => $language->site_id]);
    }

}
