<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function languages(){
        return $this->hasMany('App\Language', 'site_id', 'id');
    }
}
