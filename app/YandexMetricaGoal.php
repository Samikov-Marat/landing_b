<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YandexMetricaGoal extends Model
{
    public function project()
    {
        return $this->belongsTo(Project::class, 'id', 'project_id');
    }
}
