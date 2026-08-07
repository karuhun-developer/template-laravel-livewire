<?php

declare(strict_types=1);

namespace App\Actions\Cms\Management\Role;

use App\DTOs\Cms\Management\Role\StoreRoleData;
use App\Models\Spatie\Role;

class StoreRoleAction
{
    /**
     * Handle the action.
     */
    public function handle(StoreRoleData $data): Role
    {
        return Role::create($data->toArray());
    }
}
