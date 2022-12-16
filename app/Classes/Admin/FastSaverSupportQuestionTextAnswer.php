<?php

namespace App\Classes\Admin;

use App\SupportCategory;
use App\SupportQuestion;
use App\SupportQuestionText;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FastSaverSupportQuestionTextAnswer implements FastSaver
{
    private $icon_class;
    private $sort;

    public function __construct($templateId)
    {
        $templateQuestion = SupportQuestion::find($templateId);
        $this->sort = $templateQuestion->sort;
        $templateCategory = SupportCategory::find($templateQuestion->category_id);
        $this->icon_class = $templateCategory->icon_class;
    }

    public function save($value, $language)
    {
        try {
            $supportCategory = SupportCategory::where('icon_class', $this->icon_class)
                ->where('site_id', $language->site_id)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            dd($value, $language, $this->icon_class, $language->site_id);
        }

        try {
            $supportQuestion = SupportQuestion::where('category_id', $supportCategory->id)
                ->where('sort', $this->sort)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            dd($value, $language, $this->icon_class, $language->site_id);
        }


        try {
            $text = SupportQuestionText::select(['id', 'answer', 'question'])
                ->where('question_id', $supportQuestion->id)
                ->where('language_id', $language->id)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $text = new SupportQuestionText();
            $text->question_id = $supportQuestion->id;
            $text->language_id = $language->id;
            $text->question = '';
        }
        $text->answer = $value;
        $text->save();
    }
}
