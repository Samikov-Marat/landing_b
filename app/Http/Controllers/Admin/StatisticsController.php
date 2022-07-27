<?php

namespace App\Http\Controllers\Admin;

use App\Classes\Admin\Utm;
use App\Classes\StatisticsSitesSearcher;
use App\Classes\StatisticsUtmCampaignSearcher;
use App\Classes\StatisticsUtmContentSearcher;
use App\Classes\StatisticsUtmMediumSearcher;
use App\Classes\StatisticsUtmSourceSearcher;
use App\Classes\StatisticsUtmTermSearcher;
use App\Http\Controllers\Controller;
use App\Statistics;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(Request $request)
    {
        $columns = ['site'];

        $statisticsModel = Statistics::select(['site', DB::raw('count(*) as count')])
            ->groupBy('site')
            ->orderBy('site');
        $filter = [];

        $filter['date_from'] = new CarbonImmutable('first day of previous month');
        if ($request->has('filter.date_from')) {
            $filter['date_from'] = CarbonImmutable::createFromFormat('Y-m-d', $request->input('filter.date_from'));
        }
        $filter['date_from']->setTime(0, 0, 0);
        $statisticsModel->where('created_at', '>=', $filter['date_from']->format('Y-m-d H:i:s'));

        $filter['date_to'] = new  CarbonImmutable('last day of previous month');
        if ($request->has('filter.date_to')) {
            $filter['date_to'] = CarbonImmutable::createFromFormat('Y-m-d', $request->input('filter.date_to'));
        }
        $filter['date_to']->setTime(23, 59, 59);
        $statisticsModel->where('created_at', '<=', $filter['date_to']->format('Y-m-d H:i:s'));

        if ($request->has('filter.site')) {
            $statisticsModel->where('site', $request->input('filter.site'));
            $filter['site'] = $request->input('filter.site');
        }
        if ($request->has('filter.utm_source')) {
            $statisticsModel->where('utm_source', $request->input('filter.utm_source'));
            $filter['utm_source'] = $request->input('filter.utm_source');
            $columns[] = Utm::SOURCE;
            $statisticsModel->addSelect(Utm::SOURCE)
                ->groupBy(Utm::SOURCE);
        }
        if ($request->has('filter.utm_medium')) {
            $statisticsModel->where('utm_medium', $request->input('filter.utm_medium'));
            $filter['utm_medium'] = $request->input('filter.utm_medium');
            $columns[] = Utm::MEDIUM;
            $statisticsModel->addSelect(Utm::MEDIUM)
                ->groupBy(Utm::MEDIUM);
        }

        if ($request->has('filter.utm_campaign')) {
            $statisticsModel->where('utm_campaign', $request->input('filter.utm_campaign'));
            $filter['utm_campaign'] = $request->input('filter.utm_campaign');
            $columns[] = Utm::CAMPAIGN;
            $statisticsModel->addSelect(Utm::CAMPAIGN)
                ->groupBy(Utm::CAMPAIGN);
        }

        if ($request->has('filter.utm_term')) {
            $statisticsModel->where('utm_term', $request->input('filter.utm_term'));
            $filter['utm_term'] = $request->input('filter.utm_term');
            $columns[] = Utm::TERM;
            $statisticsModel->addSelect(Utm::TERM)
                ->groupBy(Utm::TERM);
        }

        if ($request->has('filter.utm_content')) {
            $statisticsModel->where('utm_content', $request->input('filter.utm_content'));
            $filter['utm_content'] = $request->input('filter.utm_content');
            $columns[] = Utm::CONTENT;
            $statisticsModel->addSelect(Utm::CONTENT)
                ->groupBy(Utm::CONTENT);
        }


        $detail = [];
        if ($request->has('detail.utm_source')) {
            $columns[] = Utm::SOURCE;
            $statisticsModel->addSelect(Utm::SOURCE)
                ->groupBy(Utm::SOURCE);
            $detail[Utm::SOURCE] = 1;
        }
        if ($request->has('detail.utm_medium')) {
            $columns[] = Utm::MEDIUM;
            $statisticsModel->addSelect(Utm::MEDIUM)
                ->groupBy(Utm::MEDIUM);
            $detail[Utm::MEDIUM] = 1;
        }
        if ($request->has('detail.utm_campaign')) {
            $columns[] = Utm::CAMPAIGN;
            $statisticsModel->addSelect(Utm::CAMPAIGN)
                ->groupBy(Utm::CAMPAIGN);
            $detail[Utm::CAMPAIGN] = 1;
        }
        if ($request->has('detail.utm_term')) {
            $columns[] = Utm::TERM;
            $statisticsModel->addSelect(Utm::TERM)
                ->groupBy(Utm::TERM);
            $detail[Utm::TERM] = 1;
        }
        if ($request->has('detail.utm_content')) {
            $columns[] = Utm::CONTENT;
            $statisticsModel->addSelect(Utm::CONTENT)
                ->groupBy(Utm::CONTENT);
            $detail[Utm::CONTENT] = 1;
        }


        $statistics = $statisticsModel->get();

        return view('admin.statistics.index')
            ->with('statistics', $statistics)
            ->with('filter', $filter)
            ->with('detail', $detail);
    }


    public function searchSites(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = StatisticsSitesSearcher::getInstance()->search($term, $page);
        \Debugbar::disable();
        return response()->json($languageIsoSearchResult->asArray());
    }

    public function searchUtmSource(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = StatisticsUtmSourceSearcher::getInstance()->search($term, $page);

        \Debugbar::disable();
        return response()->json($languageIsoSearchResult->asArray());
    }

    public function searchUtmMedium(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = StatisticsUtmMediumSearcher::getInstance()->search($term, $page);

        \Debugbar::disable();
        return response()->json($languageIsoSearchResult->asArray());
    }

    public function searchUtmCampaign(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = StatisticsUtmCampaignSearcher::getInstance()->search($term, $page);

        \Debugbar::disable();
        return response()->json($languageIsoSearchResult->asArray());
    }

    public function searchUtmTerm(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = StatisticsUtmTermSearcher::getInstance()->search($term, $page);

        \Debugbar::disable();
        return response()->json($languageIsoSearchResult->asArray());
    }

    public function searchUtmContent(Request $request)
    {
        $term = $request->input('term', '');
        $page = $request->input('page', 1);
        $languageIsoSearchResult = StatisticsUtmContentSearcher::getInstance()->search($term, $page);

        \Debugbar::disable();
        return response()->json($languageIsoSearchResult->asArray());
    }

}
