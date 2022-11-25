<?php

namespace App\Classes;

use Exception;

class Point
{
    var $x;
    var $y;

    function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public static function createFromWkt($wkt){
        $count = preg_match('#POINT\(.*? .*?\)#');
        if(!$count){
            throw new Exception('Неверный формат');
        }
        return new static();
    }
}
