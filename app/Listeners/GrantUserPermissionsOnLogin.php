<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class GrantUserPermissionsOnLogin
{
    public function handle(Login $event)
    {
        $user = $event->user;

        if (!$user->hasRole('admin')) {
            $user->assignRole('admin');
        }
    }
}
