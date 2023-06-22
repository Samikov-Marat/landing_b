<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Admin\SitePageStarter;
use App\Classes\SiteCloner;
use App\Http\Controllers\Controller;
use App\Page;
use App\Site;
use App\Tariff;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::select('id', 'name', 'domain', 'currency_code')
            ->orderBy('name')
            ->orderBy('id')
            ->with('currency')
            ->with('languages')
            ->with('pages')
            ->with('tariffs')
            ->with('localOffices')
            ->get();

        return view('admin.sites.index')
            ->with('sites', $sites);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $site = Site::select('id', 'name', 'domain')->find($id);
        } else {
            $site = null;
        }

        return view('admin.sites.form')
            ->with('site', $site);
    }

    public function save(Request $request)
    {
        if ($request->has('id')) {
            $site = Site::find($request->input('id'));
        } else {
            $site = new Site();
        }

        $site->domain = $request->input('domain');
        $site->name = $request->input('name');

        $site->project_id = 0;

        $site->save();

        return response()->redirectToRoute('admin.sites.index');
    }

    public function delete(Request $request)
    {
        $site = Site::find($request->input('id'));
        $site->delete();
        return response()->redirectToRoute('admin.sites.index');
    }


    public function editPageList(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with('pages')
            ->find($request->input('id'));
        $pages = Page::select('id', 'url', 'name')
            ->get();

        return view('admin.sites.page_list')
            ->with('site', $site)
            ->with('pages', $pages);
    }

    public function savePageList(Request $request)
    {
        $site = Site::select('id')
            ->with('languages')
            ->find($request->input('id'));
        $changes = $site->pages()
            ->sync($request->input('page_id') ?? []);

        $pages = Page::select('id')
            ->with('textTypes')
            ->with('textTypes.texts')
            ->find($changes['attached']);
        SitePageStarter::getInstance($site->languages)
            ->createTextsForPages($pages);

        return response()->redirectToRoute('admin.sites.index');
    }
    public function editTariffList(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with('tariffs')
            ->find($request->input('id'));
        $tariffs = Tariff::select('id', 'ek_id', 'tariff_type_id')
            ->with('tariffTexts')
            ->get();

        return view('admin.sites.tariff_list')
            ->with('site', $site)
            ->with('tariffs', $tariffs);
    }

    public function saveTariffList(Request $request)
    {
        $site = Site::select('id')
            ->find($request->input('id'));
        $site->tariffs()
            ->sync($request->input('tariff_id') ?? []);
        return response()->redirectToRoute('admin.sites.index');
    }

    public function cloneForm($id)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($id);

        return view('admin.sites.clone_form')
            ->with('site', $site);
    }

    public function clone(Request $request)
    {
        SiteCloner::getInstance()
            ->setSite($request->input('id'))
            ->setLanguage($request->input('language_id'))
            ->setNewDomain($request->input('domain'))
            ->setNewName($request->input('name'))
            ->makeClone();

        return response()->redirectToRoute('admin.sites.index');
    }

}
