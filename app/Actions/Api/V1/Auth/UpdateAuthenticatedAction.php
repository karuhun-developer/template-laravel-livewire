<?php

declare(strict_types=1);

namespace App\Actions\Api\V1\Auth;

use App\DTOs\Api\V1\Auth\UpdateAuthenticatedData;
use App\Models\User;
use App\Traits\WithMediaCollection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Cache;

class UpdateAuthenticatedAction
{
    use WithMediaCollection;

    /**
     * Handle the action.
     */
    public function handle(UpdateAuthenticatedData $data): User
    {
        $user = auth()->user();

        $user->name = $data->name;
        $user->email = $data->email;
        $user->phone = $data->phone ?? $user->phone;

        if ($data->password) {
            $user->password = bcrypt($data->password);
        }

        // Handle profile image upload
        if ($data->image instanceof UploadedFile) {
            $this->saveMedia(
                model: $user,
                file: $data->image,
                collection: 'image',
            );
        }

        // Save the user
        $user->save();

        // Clear Cache
        Cache::forget('me:user'.$user->id);

        // Save activity
        activity()->performedOn($user)->causedBy($user)->log('Update Profile');

        return $user->refresh();
    }
}
