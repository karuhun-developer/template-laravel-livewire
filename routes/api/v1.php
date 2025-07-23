<?php

use Illuminate\Support\Facades\Route;

// V1 API Routes
Route::get('/', fn() => response()->json([
    'message' => 'V1 API',
]))->name('welcome');
