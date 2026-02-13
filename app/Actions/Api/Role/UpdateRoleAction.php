<?php

namespace App\Actions\Api\User;

use App\Models\Spatie\Role;

class UpdateRoleAction
{
    /**
     * Handle the action.
     */
    public function handle(Role $role, array $data): bool
    {
        return $role->update($data);
    }
}
