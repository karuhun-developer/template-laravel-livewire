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

        // Default permission
        $permission = 'view.' . $route;

        // If API
        if($request->is('api/*')) {
            if($request->isMethod('post')) {
                $permission = 'create.' . $route;
            }

            if($request->isMethod('put')) {
                $permission = 'update.' . $route;
            }

            if($request->isMethod('delete')) {
                $permission = 'delete.' . $route;
            }

            // Check permission
            if(!Auth::user()->can($permission)) {
                throw new HttpResponseException(response()->json([
                    'code' => 403,
                    'message' => 'You do not have permission.'
                ], 403));
            }

            return $next($request);
        } else {
            // Check permission
            if(!Auth::user()->can($permission)) {
                session()->flash('error', 'You do not have permission.');

                // Redirect back
                return redirect()->back();
            }

            return $next($request);
        }
    }
}

