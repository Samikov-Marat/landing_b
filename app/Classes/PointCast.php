<?php

namespace App\Classes;

use Exception;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\DB;

class PointCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        $m = [];
        $count = preg_match('#POINT\((?<x>.*?) (?<y>.*?)\)#', $value, $m);
        if (!$count) {
            throw new Exception('Неверный формат');
        }
        return new Point($m['x'], $m['y']);
    }

    public function set($model, $key, $value, $attributes)
    {
        if (!$value instanceof Point) {
            return $value;
        }
        if (!is_numeric($value->x)) {
            throw new Exception('Неверное значение X');
        }
        if (!is_numeric($value->y)) {
            throw new Exception('Неверное значение Y');
        }
        return DB::raw('Point(' . $value->x . ', ' . $value->y . ')');
    }
}
