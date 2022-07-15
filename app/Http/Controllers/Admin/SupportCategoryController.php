<?php

namespace App\Http\Controllers\Admin;

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
        SupportRepository::loadCategoriesTo($site);
        $tree = SupportCategoryTree::getInstance($site->supportCategories)
            ->getTree();
        return view('admin.support_categories.index')
            ->with('site', $site)
            ->with('tree', $tree);
    }

    public function edit(Request $request)
    {
        if ($request->has('id')) {
            $supportCategory = SupportRepository::getCategoryWithTexts($request->input('id'));
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
        SupportRepository::loadCategoriesTo($site);
        $tree = SupportCategoryTree::getInstance($site->supportCategories)
            ->getTree();
        return view('admin.support_categories.form')
            ->with('supportCategory', $supportCategory)
            ->with('site', $site)
            ->with('parent_id', $parent_id)
            ->with('tree', $tree);
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

        if ($request->has('parent_id') && $request->input('parent_id') !== 'root') {
            $parent_id = $request->input('parent_id');
        } elseif ($supportCategory->exists) {
            $parent_id = $supportCategory->parent_id;
        } else {
            $parent_id = null;
        }
        $supportCategory->parent_id = $parent_id;
        if (!$supportCategory->exists) {
            $supportCategory->sort = SupportCategory::where('parent_id', $parent_id)->max('sort') + self::SORT_STEP;
        } elseif ($supportCategory->isDirty('parent_id')) {
            $supportCategory->sort = SupportCategory::where('parent_id', $parent_id)->max('sort') + self::SORT_STEP;
        }
        $supportCategory->save();
        $supportCategory->load('supportCategoryTexts');

        if($request->has('name')){
            $names = collect($request->input('name'));
        }
        else{
            $names = collect();
        }

        foreach ($site->languages as $language){
            if($names->has($language->id)){
                $supportCategoryText = $supportCategory->supportCategoryTexts()
                    ->firstOrNew(['language_id' => $language->id]);
                $supportCategoryText->name = $names[$language->id];
                $supportCategoryText->save();
            }
        }

        return response()
            ->redirectToRoute('admin.support_categories.index', ['site_id' => $site->id]);
    }

    public function delete(Request $request)
    {
        $supportCategory = SupportCategory::find($request->input('id'));
        $site = SupportRepository::findSite($supportCategory->site_id);
        SupportRepository::loadCategoriesTo($site);
        $childIds = SupportCategoryTree::getInstance($site->supportCategories)
            ->getBranchIdsFlat($supportCategory->id);
        SupportCategory::whereIn('id', $childIds)
            ->delete();
        return response()
            ->redirectToRoute('admin.support_categories.index', ['site_id' => $site->id]);
    }

    public function move(Request $request)
    {
        $supportCategory = SupportCategory::select('id', 'site_id', 'sort')
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
        $otherSupportCategory = SupportCategory::select('id', 'sort')
            ->where('sort', $sign, $supportCategory->sort)
            ->where('parent_id', $supportCategory->parent_id)
            ->orderBy('sort', $orderByDirection)
            ->first();

        $sort = $supportCategory->sort;
        $supportCategory->sort = $otherSupportCategory->sort;
        $supportCategory->save();
        $otherSupportCategory->sort = $sort;
        $otherSupportCategory->save();

        return response()
            ->redirectToRoute('admin.support_categories.index', ['site_id' => $supportCategory->site_id]);
    }

}
