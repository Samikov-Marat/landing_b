<?php

namespace App\Classes\Admin;

use App\SupportQuestionText;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FastSaverSupportQuestionTextQuestion implements FastSaver
{
    private $question_id;

    public function __construct($question_id)
    {
        $this->question_id = $question_id;
    }

    public function save($value, $language)
    {
        try {
            $text = SupportQuestionText::select(['id', 'answer', 'question'])
                ->where('question_id', $this->question_id)
                ->where('language_id', $language->id)
                ->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            $text = new SupportQuestionText();
            $text->question_id = $this->question_id;
            $text->language_id = $language->id;
            $text->answer = '';
        }
        $text->question = $value;
        $text->save();
    }
}
