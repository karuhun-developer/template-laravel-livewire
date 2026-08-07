<?php

declare(strict_types=1);

namespace App\Actions\Cms\Management\Role;

use App\DTOs\Cms\Management\Role\UpdateRoleData;
use App\Models\Spatie\Role;

class UpdateRoleAction
{
    /**
     * Handle the action.
     */
    public function handle(Role $role, UpdateRoleData $data): bool
    {
        return $role->update($data->toArray());
    }
}
