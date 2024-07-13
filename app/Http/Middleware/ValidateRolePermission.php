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

        // If manage page
        if(substr($route, -6) == 'manage') {
            $route = substr($route, 0, -7);

            // Check permission for create or update
            $url = explode('/', $request->path());
            $lastUrl = $url[count($url) - 1];

            if($lastUrl == 'manage') {
                $permission = 'create.' . $route;
            } else {
                $permission = 'update.' . $route;
            }
        }

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

