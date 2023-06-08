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

    public function scopeGetAllCurrencies($query)
    {
        return $query
            ->select([
                'code',
                'name',
                'symbol',
            ])
            ->orderBy('name')
            ->paginate(30);
    }

    public function getRouteKeyName(): string
    {
        return $this->primaryKey;
    }
}
