<?php

namespace App\Http\Controllers\admin;

use App\Classes\Admin\SupportCategoryTree;
use App\Classes\Admin\SupportRepository;
use App\Http\Controllers\Controller;
use App\Site;
use App\SupportCategory;
use Illuminate\Http\Request;

class SupportCategoryController extends Controller
{
    const SORT_STEP = 10;

    public function index(Request $request)
    {
        if (!$request->has('site_id')) {
            abort(500, 'site_id обязательный');
        }

        $site = SupportRepository::findSite($request->input('site_id'));
        SupportRepository::loadTexts($site);

        $tree = SupportCategoryTree::getInstance($site->supportCategories)
            ->getTree();

        return view('admin.support_categories.index')
            ->with('site', $site)
            ->with('tree', $tree);
    }

    public function add(Request $request)
    {
        if (!$request->has('site_id')) {
            abort(500, 'site_id обязательный');
        }

        if ($request->has('parent_id')) {
            $parent_id = $request->input('parent_id');
        } else {
            $parent_id = null;
        }

        $site = Site::select(['id', 'name'])
            ->with([
                       'supportCategories' => function ($q) {
                           $q->orderBy('sort');
                       }
                   ])
            ->find($request->input('site_id'));

        if ($request->has('id')) {
            $supportCategory = SupportCategory::select('*')
                ->find($request->input('id'));
        } else {
            $supportCategory = new SupportCategory();
        }

        return view('admin.support_categories.form')
            ->with('supportCategory', $supportCategory)
            ->with('site', $site)
            ->with('parent_id', $parent_id);
    }

    public function edit(Request $request)
    {
        if ($request->has('id')) {
            $supportCategory = SupportCategory::select('*')
                ->find($request->input('id'));
        } else {
            $supportCategory = new SupportCategory();
        }

        if ($supportCategory->exists) {
            $parent_id = $supportCategory->parent_id;
        } elseif ($request->has('parent_id')) {
            $parent_id = $request->input('parent_id');
        } else {
            $parent_id = null;
        }


        if ($supportCategory->exists) {
            $site_id = $supportCategory->site_id;
        } else {
            $site_id = $request->input('site_id');
        }

        $site = SupportRepository::findSite($site_id);
        SupportRepository::loadTexts($site);

        return view('admin.support_categories.form')
            ->with('supportCategory', $supportCategory)
            ->with('site', $site)
            ->with('parent_id', $parent_id);
    }

    public function save(Request $request)
    {
        if (!$request->has('site_id')) {
            abort(500, 'site_id обязательный');
        }

        $site = Site::select(['id', 'name'])
            ->with([
                       'supportCategories' => function ($q) {
                           $q->orderBy('sort');
                       }
                   ])
            ->with([
                       'languages' => function ($query) {
                           $query->select(['id', 'site_id', 'shortname', 'name'])
                               ->orderBy('sort');
                       }
                   ])
            ->find($request->input('site_id'));

        if ($request->has('id')) {
            $supportCategory = SupportCategory::select('*')
                ->find($request->input('id'));
        } else {
            $supportCategory = new SupportCategory();
        }
        $supportCategory->site_id = $site->id;
        $supportCategory->parent_id = $request->input('parent_id', null);
        if (!$supportCategory->exists) {
            $supportCategory->sort = SupportCategory::max('sort') + self::SORT_STEP;
        }
        $supportCategory->save();

        $supportCategory->load('supportCategoryTexts');

        $supportCategoryText = $supportCategory->supportCategoryTexts()
            ->firstOrNew(['language_id' => $site->languages[0]->id]);
        $supportCategoryText->name = $request->input('name');
        $supportCategoryText->save();
        return response()
            ->redirectToRoute('admin.support_categories.index', ['site_id' => $site->id]);
    }

    public function delete(Request $request)
    {
        $supportCategory = SupportCategory::find($request->input('id'));
        $site = SupportRepository::findSite($supportCategory->site_id);
        SupportRepository::loadTexts($site);
        $childIds = SupportCategoryTree::getInstance($site->supportCategories)
            ->getBranchIdsFlat($supportCategory->id);

        dd($childIds);

//        SupportCategory::whereIn('id', $childIds)
//            ->delete();
        return response()
            ->redirectToRoute('admin.support_categories.index', ['site_id' => $site->id]);
    }

}
