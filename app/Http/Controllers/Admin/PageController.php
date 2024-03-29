<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Language;
use App\Page;
use App\Site;
use Illuminate\Http\Request;

class PageController extends Controller
{
    const PER_PAGE = 10;

    const SORT_STEP = 10;

    public function index()
    {
        $pages = Page::select('id', 'url', 'name', 'template', 'is_layout', 'sort')
            ->withCount('textTypes')
            ->orderBy('sort')
            ->paginate(static::PER_PAGE);

        return view('admin.pages.index')
            ->with('pages', $pages);
    }

    public function edit($id = null)
    {
        if (isset($id)) {
            $page = Page::select('id', 'name', 'url', 'template', 'is_layout')
                ->find($id);
        } else {
            $page = null;
        }

        return view('admin.pages.form')
            ->with('page', $page);
    }

    public function save(Request $request)
    {
        $isEditMode = $request->has('id');
        if ($isEditMode) {
            $page = Page::find($request->input('id'));
        } else {
            $page = new Page();
        }

        if($request->has('url')){
            $page->url = $request->input('url');
        }
        else{
            $page->url = '';
        }

        $page->name = $request->input('name');
        $page->template = $request->input('template');
        $page->is_layout = $request->input('is_layout', false);
        if (!$isEditMode) {
            $page->sort = Page::max('sort') + self::SORT_STEP;
        }

        $page->save();

        return response()->redirectToRoute('admin.pages.index');
    }

    public function delete(Request $request)
    {
        $page = Page::find($request->input('id'));
        $page->delete();
        return response()->redirectToRoute('admin.pages.index');
    }


    public function move(Request $request)
    {
        $page = Page::select('id', 'sort')
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
        $otherPage = Page::select('id', 'sort')
            ->where('sort', $sign, $page->sort)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $page->sort;
        $page->sort = $otherPage->sort;
        $page->save();
        $otherPage->sort = $sort;
        $otherPage->save();

        return response()->redirectToRoute('admin.pages.index');
    }
}
