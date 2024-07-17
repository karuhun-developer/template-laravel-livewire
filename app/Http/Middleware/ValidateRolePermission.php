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
            // If manage page
            if(substr($route, -6) == 'manage') {
                // Delete the .manage from route
                $route = substr($route, 0, -7);

                // Check permission for create or update
                $url = explode('/', $request->path());
                $lastUrl = $url[count($url) - 1];

                // Check if last is manage or has the parameters
                if($lastUrl == 'manage') {
                    $permission = 'create.' . $route;
                } else {
                    $permission = 'update.' . $route;
                }
            }

            // Check permission
            if(!Auth::user()->can($permission)) {
                session()->flash('error', 'You do not have permission.');

                // redirect to dashboard
                return redirect()->back();
            }

            return $next($request);
        }
    }
}

