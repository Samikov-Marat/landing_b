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
            ->get();

        $this->supportCategories = SupportCategory::select(['id',])
            ->get();

        $this->supportQuestions = SupportQuestion::select(['id',])
            ->get();

        $this->languages = Language::select(['id', 'name'])
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
        fgetcsv($file);
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
        foreach ($this->textTypes as $textType) {
            if ($textType->texts()
                ->where('value', $value)
                ->count()) {
                return new FastSaverTexts($textType->id);
            }
        }

        foreach ($this->supportCategories as $supportCategory) {
            if ($supportCategory->supportCategoryTexts()
                ->where('name', $value)
                ->count()) {
                return new FastSaverSupportCategoryText($supportCategory->sort);
            }
        }

        foreach ($this->supportQuestions as $supportQuestion) {
            if ($supportQuestion->supportQuestionTexts()
                ->where('question', $value)
                ->count()) {
                return new FastSaverSupportQuestionTextQuestion($supportQuestion->id);
            }
        }
        foreach ($this->supportQuestions as $supportQuestion) {
            if ($supportQuestion->supportQuestionTexts()
                ->where('answer', $value)
                ->count()) {
                return new FastSaverSupportQuestionTextAnswer($supportQuestion->id);
            }
        }

        foreach ($this->supportQuestions as $supportQuestion) {
            if ($supportQuestion->supportQuestionTexts()
                ->where('question', 'LIKE', str_replace(' ', '%', $value))
                ->count()) {
                return new FastSaverSupportQuestionTextQuestion($supportQuestion->id);
            }
        }

        foreach ($this->supportQuestions as $supportQuestion) {
            if ($supportQuestion->supportQuestionTexts()
                ->where('answer', 'LIKE', str_replace(' ', '%', $value))
                ->count()) {
                return new FastSaverSupportQuestionTextAnswer($supportQuestion->id);
            }
        }
        throw new Exception('Не найден текст для "' . $value . '"');
    }

}
