<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function yandexMetricaGoals()
    {
        return $this->hasMany(YandexMetricaGoal::class, 'project_id', 'id');
    }
}
