<?php

namespace App\Actions\Api\User;

use App\Models\User;

class UpdateUserAction
{
    /**
     * Handle the action.
     */
    public function handle(User $user, array $data): bool
    {
        $updated = $user->update($data);

        if (isset($data['role'])) {
            $user->syncRoles([$data['role']]);
        }

        return $updated;
    }
}
