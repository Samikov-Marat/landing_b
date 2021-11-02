<?php

namespace App\Classes;

use App\Site;

class TextRepository
{
    public static function getSite($site_id)
    {
        return Site::select('id', 'name')
            ->with(
                [
                    'pages.textTypes.texts' => function ($query) {
                        $query->select('id', 'text_type_id', 'language_id', 'value');
                    }
                ]
            )
            ->with(
                [
                    'pages.textTypes' => function ($query) {
                        $query->select('id', 'page_id', 'shortname', 'name')
                            ->orderBy('sort');
                    }
                ]
            )
            ->with(
                [
                    'pages' => function ($query) {
                        $query->select('id', 'site_id', 'name', 'url')
                            ->orderBy('sort');
                    }
                ]
            )
            ->with(
                [
                    'languages' => function ($query) {
                        $query->select('id', 'site_id', 'shortname', 'name')
                            ->orderBy('sort');
                    }
                ]
            )
            ->with(
                [
                    'localOffices' => function ($query) {
                        $query->select('id', 'site_id', 'code')
                            ->orderBy('sort');
                    }
                ]
            )
            ->with(
                [
                    'localOffices.localOfficeTexts' => function ($query) {
                        $query->select('id', 'local_office_id', 'language_id', 'name', 'address', 'path', 'worktime');
                    }
                ]
            )
            ->find($site_id);
    }
}
