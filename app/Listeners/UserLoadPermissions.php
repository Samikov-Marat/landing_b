<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Authenticated;
use App\Classes\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserLoadPermissions
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
        Auth::user()->permissions = UserRepository::getAllPermissions($event->user);
    }
}
