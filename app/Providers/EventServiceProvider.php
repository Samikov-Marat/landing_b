<?php

namespace App\Providers;

use App\Listeners\LoginListener;
use App\Listeners\MenuBuilder;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\AuthenticatedListener;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Authenticated::class => [
            AuthenticatedListener::class,
        ],
        Login::class => [
            LoginListener::class,
        ],
        BuildingMenu::class => [
            MenuBuilder::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
