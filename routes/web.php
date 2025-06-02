<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => to_route('cms.dashboard'))->name('dashboard');

// Google Authentication
Route::get('/auth/google', [App\Http\Controllers\Auth\AuthGoogleController::class, 'redirect'])->name('google.redirect');
// Route to handle the callback from Google
Route::get('/callback-google', [App\Http\Controllers\Auth\AuthGoogleController::class, 'callback'])->name('google.callback');

// Redirect to main app
Route::get('/redirect', function () {
    // Create new Token
    $token = auth()->user()?->createToken('API Token')->plainTextToken;

    // Redirect to the main app with the token
    // Urlencode the token
    $token = urlencode(base64_encode($token));
    return redirect()->away(config('app.main_app_url') . '?token=' . $token);
})->name('redirect.main-app');

require __DIR__.'/cms/index.php';
require __DIR__.'/auth/index.php';
