<?php

namespace App\Classes\Admin;

use App\Site;

class SupportRepository
{
    public static function findSite($site_id)
    {
        return Site::select(['id', 'name'])
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
            ->find($site_id);
    }

    public static function loadTexts($siteWithLanguages)
    {
        if ($siteWithLanguages->languages->isEmpty()) {
            throw new \Exception('На сайте должен быть хоть один язык');
        }
        $siteWithLanguages->load([
                                     'supportCategories.supportCategoryTexts' =>
                                         function ($q) use ($siteWithLanguages) {
                                             $q->where('language_id', $siteWithLanguages->languages[0]->id);
                                         }
                                 ]);
    }

}
