<?php

namespace App\Observers;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating($user)
    {
        $user['name'] = $user['first_name'] . ' ' . $user['last_name'];
    }
}
