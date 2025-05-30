<?php

namespace App\Policies\Shop;

use App\Models\User;
use App\Models\Shop\Shop;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_shop::shop');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Shop $shop): bool
    {
        return $user->can('view_shop::shop');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_shop::shop');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Shop $shop): bool
    {
        return $user->can('update_shop::shop');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Shop $shop): bool
    {
        return $user->can('delete_shop::shop');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_shop::shop');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Shop $shop): bool
    {
        return $user->can('force_delete_shop::shop');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_shop::shop');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Shop $shop): bool
    {
        return $user->can('restore_shop::shop');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_shop::shop');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Shop $shop): bool
    {
        return $user->can('replicate_shop::shop');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_shop::shop');
    }
}
