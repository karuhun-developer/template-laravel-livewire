<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

class AuthApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Check if has header
            if(!$request->headers->has('X-API-KEY')) return $this->checkAuth($request, $next);
            $user = Crypt::decrypt($request->header('X-API-KEY'));

            // Check data
            $user = User::find($user);

            // Check if user exists
            if(!$user) return $this->checkAuth($request, $next);

            Auth::login($user);

            $request->attributes->add(['user' => $user]);

            return $next($request);
        } catch (\Throwable $th) {
            return $this->checkAuth($request, $next);
        }
    }

    public function checkAuth(Request $request, Closure $next) {
        // Check if has Bearer token
        if($request->bearerToken()) return $this->validateBearerToken($request, $next);

        if(Auth::check()) {
            return $next($request);
        } else {
            throw new HttpResponseException(response()->json([
                'code' => 401,
                'message' => 'Unauthenticated.'
            ], 401));
        }
    }

    public function validateBearerToken(Request $request, Closure $next) {
        // Check if token is valid
        if($token = PersonalAccessToken::findToken($request->bearerToken())) {
            $user = $token->tokenable;

            Auth::login($user);
            $request->attributes->add(['user' => $user]);
            return $next($request);
        } else {
            throw new HttpResponseException(response()->json([
                'code' => 401,
                'message' => 'Unauthenticated.'
            ], 401));
        }
    }
}

