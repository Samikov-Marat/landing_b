<?php

namespace App\Classes\Site;

use Illuminate\Support\Facades\Redis;

class StatisticsRedis
{
    private const BUFFER_NAME = 'statistics';
    public const COUNT_PER_STEP = 100;

    public static function save(string $json): void
    {
        Redis::rawCommand('RPUSH', self::BUFFER_NAME, $json);
    }

    public static function loadList(int $count = self::COUNT_PER_STEP): array
    {
        return Redis::rawCommand('LPOP', self::BUFFER_NAME, $count);
    }
}
