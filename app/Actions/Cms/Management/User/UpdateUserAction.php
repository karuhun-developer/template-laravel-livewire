<?php

declare(strict_types=1);

namespace App\Actions\Cms\Management\User;

use App\DTOs\Cms\Management\User\UpdateUserData;
use App\Models\User;

class UpdateUserAction
{
    /**
     * Handle the action.
     */
    public function handle(User $user, UpdateUserData $data): bool
    {
        $updated = $user->update($data->toArray());

        $user->syncRoles([$data->role]);

        return $updated;
    }
}
