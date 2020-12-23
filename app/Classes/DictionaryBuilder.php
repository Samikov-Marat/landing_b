<?php


namespace App\Classes;


use Illuminate\Database\Eloquent\Collection;

class DictionaryBuilder
{
    public static function get($pages)
    {
        $dictionary = [];
        foreach ($pages as $page) {
            $dictionary += static::getFromPage($page);
        }

        return $dictionary;
    }

    private static function getFromPage($page)
    {
        return $page->textTypes->mapWithKeys(
            function ($item) {
                return [$item->shortname => $item->texts->first()->value ?? null];
            }
        )->toArray();
    }
}
