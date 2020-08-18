<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function textTypes()
    {
        return $this->hasMany('App\TextType', 'page_id', 'id');
    }
}
