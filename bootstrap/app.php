<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \App\Providers\ViewServiceProvider::class,
        \Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,
    ])
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },
        health: '/up',
    )


    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api('throttle:60,1');
        $middleware->replace(TrimStrings::class, \App\Http\Middleware\TrimStrings::class);
        $middleware->replaceInGroup('web', ValidateCsrfToken::class, \App\Http\Middleware\VerifyCsrfToken::class);
        $middleware->redirectGuestsTo('/login');
        $middleware->redirectUsersTo('/cms');

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'auth.api-key' => \App\Http\Middleware\AuthApiKey::class,
            'validate-role-permission' => \App\Http\Middleware\ValidateRolePermission::class,
        ]);
    })


    ->withEvents(discover: [
        //
    ])


    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->stopIgnoring(AuthenticationException::class);
        $exceptions->render(function (AuthenticationException $exception, Request $request) {
            if($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'code' => 401,
                    'message' => $exception->getMessage(),
                ], 401);
            }
        });
        $exceptions->render(function (NotFoundHttpException $exception, Request $request) {
            if($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'code' => 404,
                    'message' => $exception->getMessage(),
                ], 404);
            }
        });
        $exceptions->render(function (ValidationException $exception, Request $request) {
            if($request->expectsJson() || $request->is('api/*')) {
                return response()->json([
                    'code' => 422,
                    'message' => $exception->getMessage(),
                    'errors' => $exception->errors(),
                ], 422);
            }
        });
    })->create();
