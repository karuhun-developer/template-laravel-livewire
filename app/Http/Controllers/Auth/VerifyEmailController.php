<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request, $id) {
        $user = User::findOrFail($id);
        if (!$request->hasValidSignature()) return to_route('dashboard')->with('error', 'Invalid Signature');

        // Check if user is not verified
        if (!$user->hasVerifiedEmail()) {
            // Log the event
            activity()->performedOn($user)->causedBy($user)->event('Email Verification')->log('Email Verification');

            // Mark the email as verified
            $user->markEmailAsVerified();
        }

        return view('auth.verify', compact('user'));
    }
}
