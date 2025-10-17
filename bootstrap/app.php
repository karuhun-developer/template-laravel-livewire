<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->as('api.v1.')
                ->group(base_path('routes/api/v1.php'));
            Route::middleware('web')
                ->group(base_path('routes/web/web.php'));
        },
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api('throttle:60,1');
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'auth.api-key' => \App\Http\Middleware\AuthApiKey::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return ($request->is('api/*')) || $request->expectsJson();
        });
        // Not found, unauthorized, and too many attempts handlers for API
        $exceptions->renderable(function (Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Resource not found',
                ], 404);
            }
        });
        $exceptions->renderable(function (Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'code' => 403,
                    'message' => 'This action is unauthorized.',
                ], 403);
            }
        });
        $exceptions->renderable(function (Illuminate\Http\Exceptions\ThrottleRequestsException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'code' => 429,
                    'message' => 'Too many attempts, please try again later.',
                ], 429);
            }
        });
    })->create();
