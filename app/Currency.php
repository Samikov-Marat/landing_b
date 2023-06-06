<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $code // primary key
 * @property string $text
 * @property string $symbol
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Currency extends Model
{
    protected $primaryKey = 'code';
    const COUNT_ALL_WORLD_CURRENCIES = 159;

    public function scopeGetAllCurrencies ($query): Builder {
        return $query
            ->select([
                'code',
                'name',
                'symbol'
            ])
            ->limit(self::COUNT_ALL_WORLD_CURRENCIES)
            ->orderBy('name');
    }

    public function getRouteKeyName(): string {
        return $this->primaryKey;
    }
}
