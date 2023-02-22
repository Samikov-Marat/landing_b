<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $permissions;

    public function roles()
    {
        return $this->belongsToMany(Role::class, UserRole::class);
    }

    public function franchisees()
    {
        return $this->belongsToMany(
            Franchisee::class,
            FranchiseeUser::class,
            'user_id',
            'franchisee_id',
            'id',
            'id'
        );
    }

}
