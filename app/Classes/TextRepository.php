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
                    'pages' => function ($query) {
                        $query->select('id', 'site_id', 'name', 'domain')
                            ->orderBy('sort');
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
                    'pages.textTypes.texts' => function ($query) {
                        $query->select('id', 'text_type_id', 'language_id', 'value');
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
            ->find($site_id);
    }
}
