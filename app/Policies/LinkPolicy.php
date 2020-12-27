<?php

namespace App\Policies;

use App\Models\Link;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LinkPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given link.
     *
     * @param  User  $user
     * @param  Link  $link
     * @return bool
     */
    public function destroy(User $user, Link $link)
    {
        return $user->id === $link->user_id;
    }        
}
