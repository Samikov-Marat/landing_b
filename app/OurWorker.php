<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OurWorker extends Model
{
    public function ourWorkerTexts()
    {
        return $this->hasMany('App\OurWorkerText', 'our_worker_id', 'id');
    }
}
