<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\User;

class AuthApiKey
{
    public function handle(Request $request, Closure $next): Response
    {
        // Check if has header
        if(!$request->headers->has('X-API-KEY')) return $this->checkAuth($request, $next);
        $user = Crypt::decrypt($request->header('X-API-KEY'));

        // Check if has id
        if(!array_key_exists('id', $user)) return $this->checkAuth($request, $next);
        $user = User::find($user['id']);

        // Check if user exists
        if(!$user) return $this->checkAuth($request, $next);

        Auth::login($user);

        $request->attributes->add(['user' => $user]);

        return $next($request);
    }

    public function checkAuth(Request $request, Closure $next) {
        if(Auth::check()) {
            return $next($request);
        } else {
            throw new HttpResponseException(response()->json([
                'code' => 401,
                'message' => 'Unauthenticated.'
            ], 401));
        }
    }
}

