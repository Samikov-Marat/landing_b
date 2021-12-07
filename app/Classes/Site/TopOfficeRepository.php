<?php

namespace App\Classes\Site;

use App\WorldLanguage;
use Illuminate\Database\Eloquent\Collection;

class TopOfficeRepository
{
    public static function getInstance(): self
    {
        return new static();
    }

    public function getList($language)
    {
        if (!isset($language->world_language_id)) {
            return new Collection();
        }
        $language->load([
                            'worldLanguage.topOffices' => function ($q) {
                                $q->orderBy('sort');
                            },
                            'worldLanguage.topOffices.office',
                        ]);
        return $language->worldLanguage->topOffices;
    }
}
