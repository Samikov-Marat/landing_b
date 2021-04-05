<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function languages()
    {
        return $this->hasMany('App\Language', 'site_id', 'id');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, SitePage::class);
    }

    public function images()
    {
        return $this->hasMany('App\Image', 'site_id', 'id');
    }

    public function localOffices()
    {
        return $this->hasMany('App\LocalOffice', 'site_id', 'id');
    }

}
