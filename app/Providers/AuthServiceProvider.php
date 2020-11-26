<?php

namespace App\Providers;

use App\Permission;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            return true;
        });

        $permissions = Permission::select('text_id')->get();
        foreach ($permissions as $permission) {
            Gate::define(
                $permission->text_id,
                function ($user) use ($permission) {
                    return $user->permissions->contains('text_id', $permission->text_id);
                }
            );
        }
    }
}
