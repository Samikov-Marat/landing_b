<?php

namespace App\Listeners;

use App\Classes\UserPermissionsLoader;
use Illuminate\Auth\Events\Login;

class LoginListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param IlluminateAuthEventsLogin $event
     * @return void
     */
    public function handle(Login $event)
    {
        UserPermissionsLoader::load($event->user);
    }
}
