<?php

namespace App\Classes\Admin;

use App\SupportCategory;
use App\SupportCategoryText;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FastSaverSupportCategoryText implements FastSaver
{
    private $icon_class;

    public function __construct($templateId)
    {
        $templateCategory = SupportCategory::find($templateId);

        $this->icon_class = $templateCategory->icon_class;
    }

    public function save($value, $language)
    {
        try {
            $supportCategory = SupportCategory::where('icon_class', $this->icon_class)
                ->where('site_id', $language->site_id)
                ->firstOrFail();
        }
        catch (ModelNotFoundException $exception){
            dd($value, $language, $this->icon_class, $language->site_id);
        }

        try {
            $text = SupportCategoryText::select(['id',])
                ->where('category_id', $supportCategory->id)
                ->where('language_id', $language->id)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $text = new SupportCategoryText();
            $text->category_id = $supportCategory->id;
            $text->language_id = $language->id;
        }
        $text->name = $value;
        $text->save();
    }
}
