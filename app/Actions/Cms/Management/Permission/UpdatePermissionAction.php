<?php

declare(strict_types=1);

namespace App\Actions\Cms\Management\Permission;

use App\DTOs\Cms\Management\Permission\UpdatePermissionData;
use App\Models\Spatie\Permission;

class UpdatePermissionAction
{
    /**
     * Handle the action.
     */
    public function handle(Permission $permission, UpdatePermissionData $data): bool
    {
        return $permission->update($data->toArray());
    }
}
