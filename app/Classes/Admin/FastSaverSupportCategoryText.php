<?php

namespace App\Classes\Admin;

use App\SupportCategory;
use App\SupportCategoryText;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FastSaverSupportCategoryText implements FastSaver
{
    private $sort;

    public function __construct($sort)
    {
        $this->sort = $sort;
    }

    public function save($value, $language)
    {
        try {
            $supportCategory = SupportCategory::where('sort', $this->sort)
                ->where('site_id', $language->site_id)
                ->firstOrFail();

        }
        catch (ModelNotFoundException $exception){
            dd($value, $language, $this->sort, $language->site_id);
        }



        try {
            $text = SupportCategoryText::select(['id',])
                ->where('category_id', $supportCategory->id)
                ->where('language_id', $language->id)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $text = new SupportCategoryText();
            $text->category_id = $this->sort;
            $text->language_id = $language->id;
        }
        $text->name = $value;
        $text->save();

        if(21 == $language->id){
            dump($text);
        }

    }
}
