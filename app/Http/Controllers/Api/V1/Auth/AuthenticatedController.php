<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Traits\WithMediaCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthenticatedController extends Controller
{
    use WithMediaCollection;

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (! auth()->attempt($request->only('email', 'password'))) {
            return $this->responseWithError('Your credentials are incorrect', 422);
        }

        // Save activity
        activity()->performedOn(auth()->user())->causedBy(auth()->user())->event('Login')->log('Login');

        // Delete all previous tokens
        auth()->user()->tokens()->delete();

        return $this->responseWithSuccess([
            'token' => auth()->user()->createToken('API Token')->plainTextToken,
            'token_type' => 'bearer',
        ]);
    }

    public function me(Request $request)
    {
        $ttl = now()->addMinutes(10);

        // If force refresh
        if ($request->has('forceRefresh') && $request?->forceRefresh) {
            Cache::forget('me:user'.$request->user()->id);
        }

        $user = Cache::remember('me:user'.$request->user()->id, $ttl, function () use ($request) {
            return $request->user()->load('roles');
        });

        return $this->responseWithSuccess($user);
    }

    public function update(Request $request) {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|unique:users,phone,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|image|max:2048', // Optional profile image
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        // Handle profile image upload
        if ($request->hasFile('image')) {
            $this->saveFile(
                model: $user,
                file: $request->file('image'),
                collection: 'image',
            );
        }

        $user->save();

        // Clear cache
        Cache::forget('me:user'.$user->id);

        // Save activity
        activity()->performedOn($user)->causedBy($user)->log('Update Profile');

        return $this->responseWithSuccess($user);
    }

    public function logout()
    {
        // Save activity
        activity()->performedOn(auth()->user())->causedBy(auth()->user())->event('Login')->log('Logout');

        auth()->user()->tokens()->delete();

        return $this->responseWithSuccess(message: 'Successfully logged out');
    }
}
