<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth:api'],
], function () {
    // Users Routes
    Route::get('/users', [App\Http\Controllers\Api\V1\User\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{model}', [App\Http\Controllers\Api\V1\User\UserController::class, 'show'])->name('users.show');
    Route::post('/users', [App\Http\Controllers\Api\V1\User\UserController::class, 'store'])->name('users.store');
    Route::put('/users/{model}', [App\Http\Controllers\Api\V1\User\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{model}', [App\Http\Controllers\Api\V1\User\UserController::class, 'destroy'])->name('users.destroy');
});
