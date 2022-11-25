<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocalOffice extends Model
{
    public function localOfficeTexts(): HasMany
    {
        return $this->hasMany(LocalOfficeText::class, 'local_office_id', 'id');
    }

    public function localOfficePhones(): HasMany
    {
        return $this->hasMany(LocalOfficePhone::class, 'local_office_id', 'id');
    }

    public function localOfficeEmails(): HasMany
    {
        return $this->hasMany(LocalOfficeEmail::class, 'local_office_id', 'id');
    }

    public function localOfficePhotos(): HasMany
    {
        return $this->hasMany(LocalOfficePhoto::class, 'local_office_id', 'id');
    }
}
