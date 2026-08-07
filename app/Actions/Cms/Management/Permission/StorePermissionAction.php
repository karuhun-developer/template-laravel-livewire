<?php

declare(strict_types=1);

namespace App\Actions\Cms\Management\Permission;

use App\DTOs\Cms\Management\Permission\StorePermissionData;
use App\Models\Spatie\Permission;

class StorePermissionAction
{
    /**
     * Handle the action.
     */
    public function handle(StorePermissionData $data): Permission
    {
        return Permission::create($data->toArray());
    }
}
