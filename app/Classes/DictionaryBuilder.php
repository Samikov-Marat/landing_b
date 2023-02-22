<?php


namespace App\Classes;


use Illuminate\Database\Eloquent\Collection;

class DictionaryBuilder
{
    private $textSelector;

    public function __construct($hasSubdomain)
    {
        if($hasSubdomain){
            $this->textSelector = function ($item){
                return [$item->shortname => $item->franchiseeTexts->first()->value ?? $item->texts->first()->value ?? null];
            };
        }
        else{
            $this->textSelector = function ($item){
                return [$item->shortname => $item->texts->first()->value ?? null];
            };
        }

    }

    public function get($pages)
    {
        $dictionary = [];
        foreach ($pages as $page) {
            $dictionary += $this->getFromPage($page);
        }

        return $dictionary;
    }

    private function getFromPage($page)
    {
        return $page->textTypes->mapWithKeys(
            $this->textSelector
        )->toArray();
    }
}
