<?php

namespace App\Http\Controllers\Admin;

use App\Classes\OfficeHash;
use App\Classes\TopOfficeSearcher;
use App\Http\Controllers\Controller;
use App\Office;
use App\TopOffice;
use App\WorldLanguage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class TopOfficeController extends Controller
{
    const SORT_STEP = 10;

    public function index()
    {
        $topOffices = TopOffice::select('id', 'code', 'hash')
            ->with('office', 'worldLanguages')
            ->orderBy('sort')
            ->get();
        $worldLanguageTotal = WorldLanguage::count();
        return view('admin.top_offices.index')
            ->with('topOffices', $topOffices)
            ->with('worldLanguageTotal', $worldLanguageTotal);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $topOffice = TopOffice::select('id', 'code', 'hash')->with('office:code,full_address')
                ->find($id);
        } else {
            $topOffice = null;
        }

        return view('admin.top_offices.form')
            ->with('topOffice', $topOffice);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $topOffice = TopOffice::find($request->input('id'));
        } else {
            $topOffice = new TopOffice();
        }
        try {
            $office = Office::select(
                'code',
                'name',
                'work_time',
                'address',
                'full_address',
                'address_comment',
                'email',
                'phone'
            )->where('code', $request->input('code'))
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
            abort(401, 'Не найден базовый (ЭК5) офис ' . $topOffice->code);
            return '';
        }
        $topOffice->code = $office->code;
        $topOffice->hash = OfficeHash::getInstance($office)->getHash();
        if (!$isEditMode) {
            $topOffice->sort = TopOffice::max('sort') + self::SORT_STEP;
        }
        $topOffice->save();
        return response()->redirectToRoute('admin.top_offices.index');
    }

    public function search(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $topOfficeSearchResult = TopOfficeSearcher::getInstance()->search($term, $page);
        return response()->json($topOfficeSearchResult->asArray());
    }


    public function move(Request $request)
    {
        $topOffice = TopOffice::select('id', 'sort')
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
        $otherTopOffice = TopOffice::select('id', 'sort')
            ->where('sort', $sign, $topOffice->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $topOffice->sort;
        $topOffice->sort = $otherTopOffice->sort;
        $topOffice->save();
        $otherTopOffice->sort = $sort;
        $otherTopOffice->save();

        return response()->redirectToRoute('admin.top_offices.index');
    }

    public function delete(Request $request)
    {
        $topOffice = TopOffice::findOrFail($request->input('id'));
        $topOffice->delete();
        return response()->redirectToRoute('admin.top_offices.index');
    }
}
