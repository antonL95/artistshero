<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true; // $user->hasPermissionTo('view posts');
    }


    public function view(User $user, Post $post): bool
    {
        return true; // $user->hasPermissionTo('view posts')
        //     || $user->id === $post->createdBy->id;
    }


    public function create(User $user): bool
    {
        return true; // $user->hasPermissionTo('create posts');
    }


    public function update(User $user, Post $post): bool
    {
        return true; // $user->hasPermissionTo('update posts')
        //     || $user->id === $post->createdBy->id;
    }


    public function delete(User $user, Post $post): bool
    {
        return true; // $user->hasPermissionTo('delete posts')
        //     || $user->id === $post->createdBy->id;
    }
}
