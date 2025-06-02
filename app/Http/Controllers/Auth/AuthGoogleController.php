<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthGoogleController extends Controller
{
    public function redirect() {
        return Socialite::driver('google')->redirect();
    }

    public function callback() {
        DB::beginTransaction();

        try {
            // Get the user information from Google
            $google = Socialite::driver('google')->stateless()->user();

            // Check if user already exists in the database
            // If not, create a new user
            $user = User::where('email', $google->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $google->name,
                    'email' => $google->email,
                    'password' => bcrypt(Str::random(16)), // Set a random password
                    'email_verified_at' => now()
                ]);
            }

            // Login the user
            Auth::login($user);

            DB::commit();
        } catch (Exception $e) {
            Log::error('Google authentication error: ' . $e->getMessage());
            DB::rollBack();

            return redirect('/')->with('error', 'Authentication failed. Please try again.');
        }

        return redirect('/')->with('success', 'Authentication successful. Welcome, ' . $user->name . '!');
    }
}
