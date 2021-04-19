<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alias extends Model
{

    public function site()
    {
        return $this->hasOne('App\Site', 'id', 'site_id');
    }

}
