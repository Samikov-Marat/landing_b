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
        if(app()->runningInConsole()){
            return;
        }
        $permissions = Permission::select('text_id')->get();
        foreach ($permissions as $permission) {
            Gate::define(
                $permission->text_id,
                function ($user) use ($permission) {
                    return $user->permissions->contains('text_id', $permission->text_id);
                }
            );
        }
        Gate::define(
            'is_franchisee',
            function ($user) {
                return $user->franchisees->isNotEmpty();
            }
        );
        Gate::define(
            'franchisee',
            function ($user, $franchisee) {
                return $user->franchisees->contains(function($userFranchisee, $key) use($franchisee){
                    return $userFranchisee->is($franchisee) ;
                });
            }
        );
    }
}
