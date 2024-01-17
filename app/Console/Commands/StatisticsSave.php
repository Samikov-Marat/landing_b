<?php

namespace App\Console\Commands;

use App\Classes\Site\StatisticsRedis;
use App\Exceptions\RedisBufferIsEmpty;
use App\Statistics;
use Illuminate\Console\Command;

class StatisticsSave extends Command
{
    protected $signature = 'statistics:save';
    protected $description = 'Save UTM statistics from Redis to Mysql';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $list = [];
        for ($i = 0; $i < StatisticsRedis::COUNT_PER_STEP; $i++) {
            try {
                $json = StatisticsRedis::load();
            } catch (RedisBufferIsEmpty $e) {
                break;
            }
            $statistics = new Statistics();
            $statisticsAttributes = $statistics->fromJson($json);
            $statistics->full_url = $statisticsAttributes['full_url'];
            $statistics->site = $statisticsAttributes['site'];
            $statistics->page = $statisticsAttributes['page'];
            $statistics->utm_source = $statisticsAttributes['utm_source'];
            $statistics->utm_medium = $statisticsAttributes['utm_medium'];
            $statistics->utm_campaign = $statisticsAttributes['utm_campaign'];
            $statistics->utm_term = $statisticsAttributes['utm_term'];
            $statistics->utm_content = $statisticsAttributes['utm_content'];
            $list[] = $statistics->getAttributes();
        }
        Statistics::query()->insert($list);
        return 0;
    }
}
