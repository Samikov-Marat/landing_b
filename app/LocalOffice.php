<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalOffice extends Model
{
    public function localOfficeTexts()
    {
        return $this->hasMany('App\LocalOfficeText', 'local_office_id', 'id');
    }
    public function localOfficePhones()
    {
        return $this->hasMany('App\LocalOfficePhone', 'local_office_id', 'id');
    }
    public function localOfficeEmails()
    {
        return $this->hasMany('App\LocalOfficeEmail', 'local_office_id', 'id');
    }
}
