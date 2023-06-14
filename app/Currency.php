<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $code // primary key
 * @property string $name
 * @property string $symbol
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Currency extends Model
{
    protected $primaryKey = 'code';
    private const PAGINATE_COUNT = 30;

    public function scopeBasePropsSelect($query)
    {
        return $query
            ->select([
                'code',
                'name',
                'symbol',
            ])
            ->orderBy('name');
    }

    public function getRouteKeyName(): string
    {
        return $this->primaryKey;
    }
}
