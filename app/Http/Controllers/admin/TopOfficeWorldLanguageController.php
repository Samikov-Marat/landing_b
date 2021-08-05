<?php

namespace App\Http\Controllers\admin;

use App\Classes\OfficeHash;
use App\Http\Controllers\Controller;
use App\TopOffice;
use App\TopOfficeWorldLanguage;
use App\WorldLanguage;
use Illuminate\Http\Request;

class TopOfficeWorldLanguageController extends Controller
{
    public function index(Request $request)
    {
        $topOffice = TopOffice::select('id', 'code', 'hash')
            ->with('office')
            ->findorFail($request->input('top_office_id'));
        $worldLanguages = WorldLanguage::select('id', 'language_code_iso', 'name')
            ->orderBy('sort')
            ->with(
                [
                    'topOffices' => function ($query) use ($topOffice) {
                        $query->where('top_office_id', $topOffice->id);
                    },
                    'topOffices.office'
                ]
            )
            ->get();
        return view('admin.top_office_world_language.index')
            ->with('topOffice', $topOffice)
            ->with('worldLanguages', $worldLanguages);
    }

    public function edit(Request $request)
    {
        $topOfficeWorldLanguage = TopOfficeWorldLanguage::select(
            'id',
            'top_office_id',
            'world_language_id',
            'name',
            'full_address',
            'address_comment',
            'work_time'
        )
            ->firstOrNew(
                [
                    'top_office_id' => $request->input('top_office_id'),
                    'world_language_id' => $request->input('world_language_id')
                ]
            )
            ->load('topOffice')
            ->load('worldLanguage');
        return view('admin.top_office_world_language.form')
            ->with('topOfficeWorldLanguage', $topOfficeWorldLanguage);
    }

    public function save(Request $request)
    {
        $topOffice = TopOffice::select('id', 'code')
            ->with('office')
            ->findOrFail($request->input('top_office_id'));
        $worldLanguage = WorldLanguage::select('id')->findOrFail($request->input('world_language_id'));
        $topOfficeWorldLanguage = TopOfficeWorldLanguage::select(
            'id',
            'top_office_id',
            'world_language_id',
            'name',
            'full_address',
            'address_comment',
            'work_time'
        )
            ->firstOrNew(
                [
                    'top_office_id' => $topOffice->id,
                    'world_language_id' => $worldLanguage->id,
                ]
            );

        $topOfficeWorldLanguage->name = $request->input('name');
        $topOfficeWorldLanguage->full_address = $request->input('full_address');
        $topOfficeWorldLanguage->address_comment = $request->input('address_comment');
        $topOfficeWorldLanguage->work_time = $request->input('work_time');
        $topOfficeWorldLanguage->office_hash = OfficeHash::getInstance($topOffice->office)->getHash();
        $topOfficeWorldLanguage->save();

        return response()->redirectToRoute(
            'admin.top_office_world_languages.index',
            ['top_office_id' => $topOfficeWorldLanguage->top_office_id]
        );
    }
}
