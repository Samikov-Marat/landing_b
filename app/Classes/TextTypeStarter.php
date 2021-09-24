<?php

namespace App\Classes;

use App\Site;
use App\Text;
use App\TextType;

class TextTypeStarter
{
    var $textType;

    public function __construct(TextType $textType)
    {
        $this->textType = $textType;
    }

    public static function getInstance($textType): self
    {
        return new static($textType);
    }

    public function createTextForAllSites()
    {
        $sites = Site::select('id')
            ->with('languages')
            ->whereHas('pages', function ($query) {
                $query->where('id', $this->textType->page_id);
            })
            ->get();
        foreach ($sites as $site) {
            $this->createTextForLanguages($site->languages);
        }
    }

    public function createTextForLanguages($languages)
    {
        foreach ($languages as $language) {
            $text = new Text();
            $text->text_type_id = $this->textType->id;
            $text->language_id = $language->id;
            $text->value = $this->textType->default_value;
            $text->save();
        }
    }
}
