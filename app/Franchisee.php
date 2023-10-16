<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Franchisee extends Model
{
    public function localOffices(): HasMany
    {
        return $this->hasMany(LocalOffice::class, 'franchisee_id', 'id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            FranchiseeUser::class,
            'franchisee_id',
            'user_id',
            'id',
            'id'
        );
    }

    public function franchiseeNewsArticles(): HasMany
    {
        return $this->hasMany(FranchiseeNewsArticle::class, 'franchisee_id', 'id');
    }

    public function metaTags(): BelongsToMany
    {
        return $this->belongsToMany(MetaTag::class, MetaTagFranchisee::class);
    }
}
