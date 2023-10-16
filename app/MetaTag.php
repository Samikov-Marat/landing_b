<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MetaTag extends Model
{
    public function metaTagAttributes():HasMany
    {
        return $this->hasMany(MetaTagAttribute::class, 'meta_tag_id', 'id');
    }

    public function franchisee(): BelongsToMany
    {
        return $this->belongsToMany(Franchisee::class, MetaTagFranchisee::class);
    }
}
