<?php

namespace App\Console\Commands;

use App\Site;
use App\SupportCategory;
use Illuminate\Console\Command;

class MultiplySupport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'support:multiply';

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
        $categories = SupportCategory::select('*')
            ->with('supportCategoryTexts')
            ->with('supportQuestions')
            ->with('supportQuestions.supportQuestionTexts')
            ->get();

        $sites = Site::select(['id', 'name'])
            ->with('languages')
            ->with('supportCategories')
            ->where('name', 'not like', 'Персональная%')
            ->get();


        foreach ($sites as $site) {
            if ($site->supportCategories->isEmpty()) {
                $transformation = $this->getLanguageCodesTransformation($site);
                $this->copy($site, $categories, $transformation);
            }
        }

        return 0;
    }

    private function getLanguageCodesTransformation($site){
        $transformation = [];
        $ru = $site->languages->firstWhere('language_code_iso', 'ru');
        if(isset($ru)){
            $transformation['30'] = $ru->id;
        }
        $en = $site->languages->firstWhere('language_code_iso', 'en');
        if(isset($en)){
            $transformation['31'] = $en->id;
        }
        return $transformation;
    }

    private function copy($site, $categories, $transformation)
    {
        foreach ($categories as $category) {
            $replica = $site->supportCategories()
                ->save($category->replicate());
            $this->prepareCategory($replica, $category, $transformation);
        }
    }

    private function prepareCategory($categoryReplica, $category, $transformation)
    {
        foreach ($category->supportCategoryTexts as $supportCategoryText) {
            if(isset($transformation[$supportCategoryText->language_id])){
                $textReplica = $supportCategoryText->replicate(['language_id']);
                $textReplica->language_id = $transformation[$supportCategoryText->language_id];
                $categoryReplica->supportCategoryTexts()
                    ->save($textReplica);
            }
        }

        foreach ($category->supportQuestions as $supportQuestion) {
            $questionReplica = $categoryReplica->supportQuestions()
                ->save($supportQuestion->replicate());
            $this->prepareQuestion($questionReplica, $supportQuestion, $transformation);
        }
    }

    private function prepareQuestion($questionReplica, $question, $transformation){
        foreach ($question->supportQuestionTexts as $supportQuestionText) {
            if(isset($transformation[$supportQuestionText->language_id])){
                $textReplica = $supportQuestionText->replicate(['language_id']);
                $textReplica->language_id = $transformation[$supportQuestionText->language_id];
                $questionReplica->supportQuestionTexts()
                    ->save($textReplica);
            }
        }
    }

}
