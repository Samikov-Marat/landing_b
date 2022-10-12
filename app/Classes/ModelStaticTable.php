<?php

namespace App\Classes;

trait ModelStaticTable
{
    public static function getTableStatically(){
        return (new static())->getTable();
    }
}
