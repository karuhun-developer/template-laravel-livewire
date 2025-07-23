<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Middleware\TrimStrings;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withProviders([
        \App\Providers\ViewServiceProvider::class,
        \Rap2hpoutre\LaravelLogViewer\LaravelLogViewerServiceProvider::class,
    ])
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->as('api.v1.')
                ->group(base_path('routes/api/v1.php'));

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
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            return ($request->is('api/*')) || $request->expectsJson();
        });
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Resource not found',
                ], 404);
            }
        });
    })->create();
