<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(route('dashboard', absolute: false).'?verified=1');
    }

    // public function __invoke(Request $request): RedirectResponse
    // {
    //     $user = User::find($request->route('id'));

    //     // Make sure the user is valid and hash matches
    //     if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) throw new AuthorizationException();

    //     // If the user has already verified their email return the appropriate response
    //     if ($user->markEmailAsVerified()) event(new Verified($user));

    //     return redirect()->intended(route('welcome', absolute: false).'?verified=1')->with('success', 'Email verified successfully');
    // }
}
