<?php

namespace App\Console\Commands;

use App\Classes\Admin\FastSaver;
use App\Classes\Admin\FastSaverSupportCategoryText;
use App\Classes\Admin\FastSaverSupportQuestionTextAnswer;
use App\Classes\Admin\FastSaverSupportQuestionTextQuestion;
use App\Classes\Admin\FastSaverTexts;
use App\Language;
use App\Page;
use App\SupportCategory;
use App\SupportQuestion;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ParseSupportLang extends Command
{
    protected $signature = 'support-lang:parse';

    protected $description = 'Parse Support Lang';

    protected $textTypes;

    protected $supportCategories;
    /**
     * @var Collection $languages
     */
    protected $supportQuestions;

    /**
     * @var Collection $languages
     */
    protected $languages;

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): int
    {
        $this->textTypes = Page::select(['id'])
            ->find(40)
            ->textTypes()
            ->orderBy('id')
            ->with(['texts' => function($q){
                $q->where('language_id', 30);
            }])
            ->get();

        $this->supportCategories = SupportCategory::select(['id',])
            ->get();

        $this->supportQuestions = SupportQuestion::select(['id',])
            ->get();

        $this->languages = Language::select(['id', 'site_id', 'name'])
            ->whereHas('site.pages', function (Builder $query) {
                $query->where('id', 40);
            })
            ->get();

        $fileName = Storage::path('support_lang.csv');
        $this->parseFile($fileName);
        return 0;
    }


    private function parseFile($fileName)
    {
        $file = fopen($fileName, 'r');
        $header = fgetcsv($file);
        while (($line = fgetcsv($file)) !== false) {
            $this->processLine($header, $line);
        }
    }

    private function processLine($header, $line)
    {
        $saver = $this->getSaver($line[0]);
        foreach ($header as $column => $languageNamePrefix) {
            $this->languages->filter(function ($value, $key) use ($languageNamePrefix) {
                return Str::startsWith($value->name, $languageNamePrefix);
            })->each(function ($language, $key) use ($saver, $line, $column) {
                $saver->save($line[$column], $language);
            });
        }
    }

    private function getSaver($value): FastSaver
    {
        if(preg_match('#^(\d+)$#', $value, $m)){
            return new FastSaverTexts($m[1]);
        }

        if(preg_match('#^support_category_texts\.(\d+)\.name$#', $value, $m)){
            return new FastSaverSupportCategoryText($m[1]);
        }

        if(preg_match('#^support_question_texts\.(\d+)\.question$#', $value, $m)){
            return new FastSaverSupportQuestionTextQuestion($m[1]);
        }

        if(preg_match('#^support_question_texts\.(\d+)\.answer$#', $value, $m)){
            return new FastSaverSupportQuestionTextAnswer($m[1]);
        }


        throw new Exception('Не найден текст для "' . $value . '"');
    }

}
