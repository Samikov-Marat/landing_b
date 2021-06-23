<?php

namespace App\Http\Controllers\admin;

use App\Classes\TopOfficeSearcher;
use App\Http\Controllers\Controller;
use App\TopOffices;
use Illuminate\Http\Request;

class TopOfficeController extends Controller
{
    public function index()
    {
        $topOffices = TopOffices::select('id', 'code', 'hash')
            ->orderBy('sort')
            ->get();

        return view('admin.top_offices.index')
            ->with('topOffices', $topOffices);
    }


    public function edit($id = null)
    {
        if (isset($id)) {
            $topOffice = TopOffices::select('id', 'code', 'domain')->find($id);
        } else {
            $topOffice = null;
        }

        return view('admin.top_offices.form')
            ->with('topOffice', $topOffice);
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

        $site->save();

        return response()->redirectToRoute('admin.sites.index');
    }

    public function search(Request $request)
    {
        $topOfficeSearcher = TopOfficeSearcher::getInstance(
            $request->input('term'),
            $request->input('page', 1)
        );
        \Debugbar::disable();
        return response()->json($topOfficeSearcher->search()->asArray());
    }


}
