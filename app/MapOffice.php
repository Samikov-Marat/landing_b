<?php

namespace App;

use App\Classes\PointCast;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class MapOffice extends Model
{
    protected $casts = ['coordinates' => PointCast::class];

    public function scopeFixCoordinates($query)
    {
        return $query->addSelect(DB::raw('ST_AsWKT(coordinates) AS coordinates'));
    }

    public function scopeWithinRectangle($query, $x, $y, $x2, $y2)
    {
        return $query->whereRaw(
            'MbrWithin(coordinates, MultiPoint(Point(?, ?), Point(?, ?)))',
            [$x, $y, $x2, $y2]
        );
    }
}
