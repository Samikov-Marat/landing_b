<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function newsArticles()
    {
        return $this->hasMany('App\NewsArticle', 'site_id', 'id');
    }

    public function ourWorkers()
    {
        return $this->hasMany('App\OurWorker', 'site_id', 'id');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Feedback', 'site_id', 'id');
    }

    public function certificateChecks()
    {
        return $this->hasOne(CertificateChecks::class, 'site_id', 'id');
    }


    public function supportCategories(): HasMany
    {
        return $this->hasMany(SupportCategory::class, 'site_id', 'id');
    }

}
