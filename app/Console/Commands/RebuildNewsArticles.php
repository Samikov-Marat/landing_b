<?php

namespace App\Console\Commands;

use App\NewsArticle;
use App\NewsArticleText;
use Illuminate\Console\Command;

class RebuildNewsArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rebuild:news';

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
        $newsArticle = NewsArticle::select([
                                               'id',
                                               'site_id',
                                               'language_id',
                                               'publication_date',

                                               'header',
                                               'note',
                                               'text',
                                               'publication_date_text',
                                           ])
            ->orderby('site_id')
            ->orderby('language_id')
            ->orderby('publication_date', 'desc')
            ->get();

        $grouped = $newsArticle->groupBy(function ($newsArticle, $key) {
            return $newsArticle->site_id . ' ' . $newsArticle->publication_date->format('Y.m.d');
        });

        foreach ($grouped as $k=>$group){
            foreach ($group as $oldNews){
                $text = new NewsArticleText();
                $text->news_article_id = $group[0]->id;
                $text->language_id = $oldNews->language_id;
                $text->header = $oldNews->header;
                $text->note = $oldNews->note;
                $text->text = $oldNews->text;
                $text->publication_date_text = $oldNews->publication_date_text;
                $text->save();
                if($oldNews->id != $group[0]->id){
                    $oldNews->delete();
                }
            }

        }
        return 0;
    }


}
