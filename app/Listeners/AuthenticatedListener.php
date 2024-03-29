<?php

namespace App\Listeners;

use App\Classes\UserPermissionsLoader;
use Illuminate\Auth\Events\Authenticated;

class AuthenticatedListener
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
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        UserPermissionsLoader::load($event->user);
    }
}
