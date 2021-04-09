<?php

namespace App\Http\Controllers\admin;

use App\Classes\LocalOfficeRepository;
use App\Http\Controllers\Controller;
use App\LocalOffice;
use App\LocalOfficeText;
use App\Site;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LocalOfficeController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $site = Site::select('id', 'name', 'domain')
            ->with(
                [
                    'localOffices' => function ($query) {
                        $query->select(
                            'id',
                            'site_id',
                            'code',
                            'utm_tag',
                            'utm_value',
                            'category',
                            'sort'
                        )
                            ->orderBy('sort');
                    },
                    'localOffices.localOfficeTexts' => function ($query) {
                        $query->select('id', 'local_office_id', 'name');
                    },

                ]
            )
            ->find($request->input('site_id'));
        return view('admin.local_offices.index')
            ->with('site', $site);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $localOffice = LocalOffice::select('id', 'code', 'utm_tag', 'utm_value', 'category', 'site_id')
                ->find($id);
            $siteId = $localOffice->site_id;
        } else {
            $localOffice = null;
            $siteId = $request->input('site_id');
        }
        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($siteId);


        return view('admin.local_offices.form')
            ->with('site', $site)
            ->with('localOffice', $localOffice);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $localOffice = LocalOffice::find($request->input('id'));
        } else {
            $localOffice = new LocalOffice();
        }
        $localOffice->site_id = $request->input('site_id');
        $localOffice->code = $request->input('code') ?? '';
        $localOffice->utm_tag = $request->input('utm_tag') ?? '';
        $localOffice->utm_value = $request->input('utm_value') ?? '';
        $localOffice->category = $request->input('category') ?? '';
        if (!$isEditMode) {
            $localOffice->sort = LocalOffice::where('site_id', $localOffice->site_id)->max('sort') + self::SORT_STEP;
        }
        $localOffice->save();


        $site = Site::select('id', 'name', 'domain')
            ->with('languages')
            ->find($localOffice->site_id);

        $localOfficeRepository = LocalOfficeRepository::getInstance($localOffice);
        foreach ($site->languages as $language) {
            $localOfficeText = $localOfficeRepository->getTextByLanguage($language->id);
            $localOfficeText->name = $request->input('name')[$language->id] ?? '';
            $localOfficeText->address = $request->input('address')[$language->id] ?? '';
            $localOfficeText->path = $request->input('path')[$language->id] ?? '';
            $localOfficeText->worktime = $request->input('worktime')[$language->id] ?? '';
            $localOfficeText->save();
        }

        return response()->redirectToRoute('admin.local_offices.index', ['site_id' => $localOffice->site_id]);
    }

    public function delete(Request $request)
    {
        $localOffice = LocalOffice::select('id', 'site_id')
            ->find($request->input('id'));
        $site_id = $localOffice->site_id;
        $localOffice->delete();
        return response()->redirectToRoute('admin.local_offices.index', ['site_id' => $site_id]);
    }

    public function move(Request $request)
    {
        $localOffice = LocalOffice::select('id', 'site_id', 'sort')
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
        $otherLocalOffice = LocalOffice::select('id', 'sort')
            ->where('site_id', $localOffice->site_id)
            ->where('sort', $sign, $localOffice->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $localOffice->sort;
        $localOffice->sort = $otherLocalOffice->sort;
        $localOffice->save();
        $otherLocalOffice->sort = $sort;
        $otherLocalOffice->save();

        return response()->redirectToRoute('admin.local_offices.index', ['site_id' => $localOffice->site_id]);
    }

}
