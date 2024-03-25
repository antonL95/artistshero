<?php

namespace App\Policies;

use App\Models\Filter;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FilterPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true; // $user->hasPermissionTo('view filters');
    }


    public function view(User $user, Filter $filter): bool
    {
        return true; // $user->hasPermissionTo('view filters') || $user->id === $filter->createdBy->id;
    }


    public function create(User $user): bool
    {
        return true; // $user->hasPermissionTo('create filters');
    }


    public function update(User $user, Filter $filter): bool
    {
        return true; // $user->hasPermissionTo('update filters')
           // || $user->id === $filter->createdBy->id;
    }


    public function delete(User $user, Filter $filter): bool
    {
        return true; // $user->hasPermissionTo('delete filters')
           // || $user->id === $filter->createdBy->id;
    }
}
