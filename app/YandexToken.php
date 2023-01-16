<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property-read int id
 * @property string access_token
 * @property string refresh_token
 * @property string login
 * @method static Builder|YandexToken query()
 */
class YandexToken extends Model
{
    protected $dates = ['received_at'];
}
