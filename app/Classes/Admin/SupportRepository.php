<?php

namespace App\Classes\Admin;

use App\Site;
use App\SupportCategory;

class SupportRepository
{
    public static function findSite($site_id)
    {
        return Site::select(['id', 'name'])
            ->with([
                       'languages' => function ($query) {
                           $query->select(['id', 'site_id', 'shortname', 'name'])
                               ->orderBy('sort');
                       }
                   ])
            ->find($site_id);
    }

    public static function loadCategoriesTo($siteWithLanguages)
    {
        if ($siteWithLanguages->languages->isEmpty()) {
            throw new \Exception('На сайте должен быть хоть один язык');
        }
        $siteWithLanguages->load([
                                     'supportCategories' => function ($q) {
                                         $q->orderBy('sort');
                                     },
                                     'supportCategories.supportCategoryTexts' =>
                                         function ($q) use ($siteWithLanguages) {
                                             $q->where('language_id', $siteWithLanguages->languages[0]->id);
                                         }
                                 ]);
    }

    public static function getCategoryWithTexts($id){
        return SupportCategory::select(['id', 'parent_id', 'site_id', 'icon_class'])
            ->with('supportCategoryTexts')
            ->find($id);


    }

}
