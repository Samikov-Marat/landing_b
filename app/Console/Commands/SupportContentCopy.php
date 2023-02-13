<?php

namespace App\Console\Commands;

use App\Classes\Admin\SitePageStarter;
use Illuminate\Console\Command;
use App\Site;
use App\SupportCategory;
use App\SupportCategoryText;
use App\SupportQuestion;
use App\SupportQuestionText;
use App\Page;
use App\TextType;
use App\Text;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SupportContentCopy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:support-content';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitePrototype = Site::query()
            ->where('id', 13)
            ->first();

        $sites = Site::query()
            ->where('id', '<>', 13)
            ->with('languages')
            ->get();

        foreach ($sites as $site) {
            if ($site->pages->contains(function ($page) {
                return 'support' == $page->url;
            })) {
                $this->copyCategories($sitePrototype, $site);
            }

        }
        return 0;
    }

    private function copyCategories(Site $sitePrototype, Site $site)
    {
        $categories = $sitePrototype->supportCategories;
        foreach ($categories as $category) {
            if (!$site->supportCategories->contains(function ($supportCategories) use ($category) {
                return $category->icon_class == $supportCategories->icon_class;
            })){
                $questions = $category->supportQuestions;
                $categoryTextRU = $category->supportCategoryTexts()->where('language_id', 30)->first();

                $supportCategory = new SupportCategory();
                $supportCategory->site_id = $site->id;
                $supportCategory->sort = $category->sort;
                $supportCategory->icon_class = $category->icon_class;

                $supportCategoryTexts = $this->copyCategoriesTexts($site, $categoryTextRU->name);
                $supportCategoryQuestions = $this->copyCategoryQuestions($questions);

                $site->supportCategories()->save($supportCategory);
                $supportCategory->supportCategoryTexts()->saveMany($supportCategoryTexts);
                $supportCategory->supportQuestions()->saveMany($supportCategoryQuestions);

                foreach ($questions as $key => $question){
                    $questionTextRU = $question->supportQuestionTexts()->where('language_id', 30)->first();
                    $supportCategoryQuestionsTexts = $this->copyCategoryQuestionsTexts($site, $question, $questionTextRU);

                    $supportCategoryQuestions[$key]->supportQuestionTexts()->saveMany($supportCategoryQuestionsTexts);
                }
            }

        }
    }

    private function copyCategoriesTexts(Site $site, string $categoryTextRU)
    {
        $categoryTexts = new Collection();
        foreach ($site->languages as $language){
            $categoryText = new SupportCategoryText();
            $categoryText->language_id = $language->id;
            $categoryText->name = '';
            if ($language->language_code_iso == 'ru'){
                $categoryText->name = $categoryTextRU;
            }
            $categoryTexts->push($categoryText);
        }
        return $categoryTexts;
    }

    private function copyCategoryQuestions(Collection $questions)
    {
        $categoryQuestions = new Collection();
        foreach ($questions as $question){
            $categoryQuestion = new SupportQuestion();
            $categoryQuestion->show_form = $question->show_form;
            $categoryQuestion->icon_class = $question->icon_class;
            $categoryQuestion->sort = $question->sort;
            $categoryQuestions->push($categoryQuestion);
        }
        return $categoryQuestions;
    }

    private function copyCategoryQuestionsTexts(Site $site, SupportQuestion $question, Model $questionTextRU)
    {
        $categoryQuestionsTexts = new Collection();
        foreach ($site->languages as $language){
            $questionText = new SupportQuestionText();
            $questionText->language_id = $language->id;
            $questionText->question = '';
            $questionText->answer = '';
            if ($language->language_code_iso == 'ru'){
                $questionText->question = $questionTextRU->question;
                $questionText->answer = $questionTextRU->answer;
            }
            $categoryQuestionsTexts->push($questionText);
        }
        return $categoryQuestionsTexts;
    }
}
