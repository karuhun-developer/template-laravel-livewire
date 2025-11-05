<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json([
        'message' => 'V1 API',
    ]);
})->name('welcome');

// Authentication Routes
require 'v1/auth.php';
