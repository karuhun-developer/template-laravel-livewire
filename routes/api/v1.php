<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    // Welcome Route
    Route::get('/', function () {
        return response()->json([
            'message' => 'V1 API',
        ]);
    })->name('welcome');

    // Authentication Routes
    require 'v1/auth.php';

    // Role Routes
    require 'v1/role.php';

    // Settings Routes
    require 'v1/setting.php';

    // User Routes
    require 'v1/user.php';
});
