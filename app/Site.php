<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    public function languages()
    {
        return $this->hasMany(Language::class, 'site_id', 'id');
    }

    public function pages()
    {
        return $this->belongsToMany(Page::class, SitePage::class);
    }

    public function getSpecificPage(string $pageName): Page
    {
        return $this->pages()->where('url', $pageName)->first();
    }

    public function tariffs()
    {
        return $this->belongsToMany(Tariff::class, SiteTariff::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'site_id', 'id');
    }

    public function localOffices()
    {
        return $this->hasMany(LocalOffice::class, 'site_id', 'id')
            ->orderBy('sort');
    }

    public function newsArticles()
    {
        return $this->hasMany(NewsArticle::class, 'site_id', 'id');
    }

    public function ourWorkers()
    {
        return $this->hasMany(OurWorker::class, 'site_id', 'id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'site_id', 'id');
    }

    public function certificateChecks()
    {
        return $this->hasOne(CertificateChecks::class, 'site_id', 'id');
    }


    public function supportCategories(): HasMany
    {
        return $this->hasMany(SupportCategory::class, 'site_id', 'id');
    }

    public function getEnabledLanguagesAttribute()
    {
        // TODO: поискать другой способ
        return $this->languages->filter(function ($language, $key) {
            return !$language->disabled;
        });
    }

    public function defaultLanguages()
    {
        return $this->belongsToMany(Language::class, DefaultLanguage::class);
    }

    public function currency()
    {
        return $this->hasOne(Currency::class, 'code', 'currency_code');
    }

    public function metaTags(): HasMany
    {
        return $this->hasMany(MetaTag::class, 'site_id', 'id');
    }
}
