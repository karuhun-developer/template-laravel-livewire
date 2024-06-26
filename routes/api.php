<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'GGWP',
    ]);
})->middleware(['api']);

Route::get('/auth', function () {
    return response()->json([
        'GGWP',
    ]);
})->middleware(['api', 'auth:api']);


Route::get('/apikey', function () {
    return response()->json([
        'GGWP',
    ]);
})->middleware(['api', 'auth.api-key']);
