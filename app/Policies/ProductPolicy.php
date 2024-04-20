<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true; // $user->hasPermissionTo('view products');
    }

    public function view(User $user, Product $product): bool
    {
        return true; // $user->hasPermissionTo('view products')
        //     || $user->id === $product->createdBy->id;
    }

    public function create(User $user): bool
    {
        return true; // $user->hasPermissionTo('create products');
    }

    public function update(User $user, Product $product): bool
    {
        return true; // $user->hasPermissionTo('update products')
        //     || $user->id === $product->createdBy->id;
    }

    public function delete(User $user, Product $product): bool
    {
        return true; // $user->hasPermissionTo('delete products')
        //     || $user->id === $product->createdBy->id;
    }
}
