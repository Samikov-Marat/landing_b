<?php

namespace App\Http\Controllers\admin;

use App\Classes\TextTypeStarter;
use App\Http\Controllers\Controller;
use App\Page;
use App\TextType;
use Illuminate\Http\Request;

class TextTypeController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        $page = Page::select('id', 'url', 'name')
            ->with(
                [
                    'textTypes' => function ($query) {
                        $query->select('id', 'page_id', 'shortname', 'name')
                            ->orderBy('sort');
                    }
                ]
            )
            ->find($request->input('page_id'));
        return view('admin.text_types.index')
            ->with('page', $page);
    }

    public function edit($id = null, Request $request)
    {
        if (isset($id)) {
            $textType = TextType::select('id', 'shortname', 'name', 'default_value', 'page_id')
                ->find($id);
            $pageId = $textType->page_id;
        } else {
            $textType = null;
            $pageId = $request->input('page_id');
        }
        $page = Page::select('id', 'name', 'url')
            ->find($pageId);

        return view('admin.text_types.form')
            ->with('page', $page)
            ->with('textType', $textType);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $textType = TextType::find($request->input('id'));
        } else {
            $textType = new TextType();
        }

        $textType->page_id = $request->input('page_id');
        $textType->shortname = $request->input('shortname');
        $textType->name = $request->input('name');
        $textType->default_value = $request->input('default_value');

        if (!$isEditMode) {
            $textType->sort = TextType::where('page_id', $textType->page_id)->max('sort') + self::SORT_STEP;
        }

        $textType->save();

        if (!$isEditMode) {
            TextTypeStarter::getInstance($textType)
                ->createTextForAllSites();
        }
        return response()->redirectToRoute('admin.text_types.add', ['page_id' => $textType->page_id]);
    }


    public function delete(Request $request)
    {
        $textType = TextType::select('id', 'page_id')
            ->find($request->input('id'));
        $page_id = $textType->page_id;
        $textType->delete();
        return response()->redirectToRoute('admin.text_types.index', ['page_id' => $page_id]);
    }


    public function move(Request $request)
    {
        $textType = TextType::select('id', 'page_id', 'sort')
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
        $otherTextType = TextType::select('id', 'sort')
            ->where('page_id', $textType->page_id)
            ->where('sort', $sign, $textType->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $textType->sort;
        $textType->sort = $otherTextType->sort;
        $textType->save();
        $otherTextType->sort = $sort;
        $otherTextType->save();

        return response()->redirectToRoute('admin.text_types.index', ['page_id' => $textType->page_id]);
    }
}
