<?php

namespace App\Actions\Api\User;

use App\Models\Spatie\Role;

class DeleteRoleAction
{
    /**
     * Handle the action.
     */
    public function handle(Role $role): ?bool
    {
        return $role->delete();
    }
}
