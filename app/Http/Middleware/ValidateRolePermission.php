<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;

class ValidateRolePermission
{
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route()->getName();
        $permission = 'view.' . $route;

        if(!Auth::user()->can($permission)) {
            if($request->is('api/*')) {
                throw new HttpResponseException(response()->json([
                    'code' => 403,
                    'message' => 'You do not have permission.'
                ], 403));
            } else {
                // redirect to dashboard
                return redirect()->route('cms.dashboard');
            }

        }

        return $next($request);
    }
}

