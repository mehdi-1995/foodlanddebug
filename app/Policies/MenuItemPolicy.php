<?php

namespace App\Policies;

use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MenuItemPolicy
{
    /**
     * Determine whether the user can update the menu item.
     */
    public function update(User $user, MenuItem $menuItem): Response
    {
        return $user->id === $menuItem->restaurant->user_id
            ? Response::allow()
            : Response::deny('شما اجازه ویرایش این آیتم را ندارید.');
    }

    /**
     * Determine whether the user can delete the menu item.
     */
    public function delete(User $user, MenuItem $menuItem): Response
    {
        return $user->id === $menuItem->restaurant->user_id
            ? Response::allow()
            : Response::deny('شما اجازه حذف این آیتم را ندارید.');
    }
}
