<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TextType
 *
 * @property int $id
 * @property int $page_id
 * @property string $shortname
 * @property string $name
 * @property string $default_value
 * @property int $sort
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|TextType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TextType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TextType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TextType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TextType whereDefaultValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TextType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TextType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TextType wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TextType whereShortname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TextType whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TextType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TextType extends Model
{
    public function texts()
    {
        return $this->hasMany('App\Text', 'text_type_id', 'id');
    }

}
