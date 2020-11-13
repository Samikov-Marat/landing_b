<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $primaryKey = 'text_id';
    protected $keyType = 'string';

    public function roles()
    {
        return $this->belongsToMany(Role::class, RolePermission::class);
    }
}
