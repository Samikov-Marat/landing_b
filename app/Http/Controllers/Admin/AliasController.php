<?php

namespace App\Http\Controllers\Admin;

use App\Alias;
use App\Classes\AliasSitesSearcher;
use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;

class AliasController extends Controller
{
    public function index(Request $request)
    {
        $aliases = Alias::select(['id', 'site_id', 'domain', 'public'])
            ->orderBy('id')
            ->with('site')
            ->get();
        $languages = Language::select('*')->get();
        return view('admin.alias.index')
            ->with('aliases', $aliases)
            ->with('aliases', $languages);
    }

    public function edit(Request $request)
    {
        if ($request->route()->hasParameter('id')) {
            $alias = Alias::select(['id', 'site_id', 'domain', 'public'])
                ->with('site')
                ->findOrFail($request->route()->parameter('id'));
        } else {
            $alias = new Alias();
        }
        return view('admin.alias.form')
            ->with('alias', $alias);
    }

    public function save(Request $request)
    {
        if ($request->has('id')) {
            $alias = Alias::find($request->input('id'));
        } else {
            $alias = new Alias();
        }
        $alias->site_id = $request->input('site_id');
        $alias->domain = $request->input('domain');
        $alias->public = $request->input('public', false);
        $alias->save();
        return response()->redirectToRoute('admin.aliases.index');
    }

    public function searchSites(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $siteSearchResult = AliasSitesSearcher::getInstance()->search($term, $page);
        return response()->json($siteSearchResult->asArray());
    }

    public function delete(Request $request)
    {
        $alias = Alias::find($request->input('id'));
        $alias->delete();
        return response()->redirectToRoute('admin.aliases.index');
    }

}
