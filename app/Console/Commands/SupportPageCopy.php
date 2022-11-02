<?php

namespace App\Console\Commands;

use App\Classes\Admin\SitePageStarter;
use App\Page;
use App\Site;
use App\Text;
use App\TextType;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;

class SupportPageCopy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'copy:support-page';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $dataTexts = [];

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
        $sitePrototype = Site::select('*')
            ->where('id', 13)
            ->with('languages')
            ->first();

        $pagePrototype = $sitePrototype->pages()
            ->where('url', 'support')
            ->with('textTypes')
            ->with('textTypes.texts')
            ->first();

        foreach ($pagePrototype->textTypes as $textType) {
            $texts = $textType->texts()
                ->whereIn('language_id', $sitePrototype->languages->pluck('id'))
                ->with('language')
                ->get();
            foreach ($texts as $text) {
                $this->dataTexts[$text->language->language_code_iso][$textType->shortname] = $text->value;
            }
        }

        $this->attach($pagePrototype);

        $sites = Site::has('supportCategories')
            ->where('id', '<>', 13)
            ->with([
                       'pages' => function ($q) {
                           $q->where('url', 'support');
                       }
                   ])
            ->get();


        foreach ($sites as $site) {
            $this->updateTextTypes($site);
        }
        return 0;
    }

    private function attach($pagePrototype)
    {
        $sites = Site::has('supportCategories')
            ->where('id', '<>', 13)
            ->get();

        foreach ($sites as $site) {
            if (!$site->pages->contains(function ($page, $key) {
                return 'support' == $page->url;
            })) {
                $site->pages()->attach($pagePrototype->id);
                SitePageStarter::getInstance($site->languages)
                    ->createTextsForPages(collect([$pagePrototype]));
            }
        }
    }

    private function updateTextTypes(Site $site)
    {
        $page = $site->pages->firstWhere('url', 'support');
        foreach ($page->textTypes as $textType) {
            $this->update($textType);
        }
    }

    private function update(TextType $textType)
    {
        $textType->load('texts')
            ->load('texts.language');
        foreach ($textType->texts as &$text) {
            if (isset($this->dataTexts[$text->language->language_code_iso][$textType->shortname])) {
                $text->value = $this->dataTexts[$text->language->language_code_iso][$textType->shortname];
                $text->save();
            }
        }
        $textType->unsetRelation('texts');
    }

}
