<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'as' => 'api.v1.',
], function () {
    Route::get('/status', function () {
        return response()->json(['status' => 'API v1 is operational']);
    })->name('status');
});
