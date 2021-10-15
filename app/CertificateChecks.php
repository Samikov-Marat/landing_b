<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificateChecks extends Model
{
    protected $primaryKey = 'site_id';
    public $incrementing = false;
    protected $casts = [
        'valid_to' => 'datetime',
    ];
}
