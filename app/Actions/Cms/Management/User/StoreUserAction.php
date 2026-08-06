<?php

namespace App\Actions\Cms\Management\User;

use App\DTOs\Cms\Management\User\StoreUserData;
use App\Models\User;

class StoreUserAction
{
    /**
     * Handle the action.
     */
    public function handle(StoreUserData $data): User
    {
        $user = User::create($data->toArray());

        $user->syncRoles([$data->role]);

        return $user;
    }
}
