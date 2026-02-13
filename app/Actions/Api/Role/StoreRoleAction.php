<?php

namespace App\Actions\Api\User;

use App\Models\Spatie\Role;

class StoreRoleAction
{
    /**
     * Handle the action.
     */
    public function handle(array $data): Role
    {
        return Role::create($data);
    }
}
