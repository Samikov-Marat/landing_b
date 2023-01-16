<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property-read int id
 * @property string name
 * @property string description
 * @method static Builder|YandexMetricaGoal query()
 */
class YandexMetricaGoal extends Model
{
    public function project()
    {
        return $this->belongsTo(Project::class, 'id', 'project_id');
    }
}
