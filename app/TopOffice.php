<?php

namespace App;

use App\Classes\OfficeHash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TopOffices extends Model
{
    public function office(): HasOne
    {
        return $this->hasOne('App\Office', 'code', 'code');
    }

    public function getIsActualAttribute()
    {
        if(!isset($this->office)){
            throw new \Exception('Нет базового офиса');
        }
        return OfficeHash::getInstance($this->office)->getHash() == $this->hash;
    }
}
