<?php

declare(strict_types=1);

namespace App\Actions\Api\V1\Auth;

use App\DTOs\Api\V1\Auth\StoreAuthenticatedData;

class StoreAuthenticatedAction
{
    /**
     * Handle the action.
     */
    public function handle(StoreAuthenticatedData $data): bool
    {
        if (! auth()->attempt($data->toArray())) {
            return false;
        }

        // Save activity
        activity()->performedOn(auth()->user())->causedBy(auth()->user())->event('Login')->log('Login');

        // Delete all previous tokens
        // auth()->user()->tokens()->delete();

        return true;
    }
}
