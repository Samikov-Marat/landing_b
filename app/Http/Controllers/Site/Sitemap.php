<?php

namespace App\Http\Controllers\Site;

use App\Classes\Domain;
use App\Classes\SitemapXml;
use App\Classes\SiteRepository;
use App\Http\Controllers\Controller;
use App\SupportCategory;
use App\Text;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Sitemap extends Controller
{
    public function get(Request $request)
    {
        $domain = app(Domain::class);
        $siteRepository = new SiteRepository($domain);

        $site = $siteRepository->getSite();
        $pages = $siteRepository->getSeparatePages();

        $supportCategories = SupportCategory::select(['id'])
            ->where('site_id', $site->id)
            ->whereNull('parent_id')
            ->orderBy('sort')
            ->get();
        $supportCategories->load(
            [
                'supportQuestions' => function ($q) {
                    $q->where('icon_class', '')
                        ->orderBy('sort');
                }
            ]
        );

        $lastmod = Carbon::parse(Text::max('updated_at'));

        $xml = new SitemapXml($pages);
        $xml->setSite($site);
        $xml->setLastmod($lastmod);
        $xml->setSupportCategories($supportCategories);
        $xml->output();
    }
}
