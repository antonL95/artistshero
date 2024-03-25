<?php

namespace App\Policies;

use App\Models\Artist;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtistPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true; // $user->hasPermissionTo('view artists');
    }


    public function view(User $user, Artist $artist): bool
    {
        return true; // $user->hasPermissionTo('view artists')
        //     || $user->id === $artist->createdBy->id;
    }


    public function create(User $user): bool
    {
        return true; // $user->hasPermissionTo('create artists');
    }


    public function update(User $user, Artist $artist): bool
    {
        return true; // $user->hasPermissionTo('update artists')
        //     || $user->id === $artist->createdBy->id;
    }


    public function delete(User $user, Artist $artist): bool
    {
        return true; // $user->hasPermissionTo('delete artists')
        //     || $user->id === $artist->createdBy->id;
    }
}
