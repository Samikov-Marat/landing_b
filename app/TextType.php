<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TextType extends Model
{
    public function texts()
    {
        return $this->hasMany('App\Text', 'text_type_id', 'id');
    }
}
