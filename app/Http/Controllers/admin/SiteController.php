<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    const PER_PAGE = 10;

    function index()
    {
        $sites = Site::select('id', 'name', 'domain')
            ->paginate(static::PER_PAGE);

        return view('admin.sites.index')
            ->with('sites', $sites);
    }

    function edit($id = null)
    {
        if (isset($id)) {
            $site = Site::select('id', 'name', 'domain')->find($id);
        } else {
            $site = null;
        }

        return view('admin.sites.form')
            ->with('site', $site);
    }

    function save(Request $request)
    {
        if ($request->has('id')) {
            $site = Site::find($request->get('id'));
        } else {
            $site = new Site();
        }

        $site->domain = $request->get('domain');
        $site->name = $request->get('name');

        $site->save();

        return response()->redirectToRoute('admin.sites.index');
    }

    function delete(Request $request){
        $site = Site::find($request->get('id'));
        $site->delete();
        return response()->redirectToRoute('admin.sites.index');
    }
}
