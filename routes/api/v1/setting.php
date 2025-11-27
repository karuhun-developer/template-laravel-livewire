<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'setting',
    'as' => 'setting.',
    'middleware' => ['auth:api'],
], function () {
    // Setting
    Route::get('/', [App\Http\Controllers\Api\V1\Setting\SettingController::class, 'show'])->name('show');
    Route::put('/', [App\Http\Controllers\Api\V1\Setting\SettingController::class, 'update'])->name('update');
    Route::post('/file', [App\Http\Controllers\Api\V1\Setting\SettingController::class, 'file'])->name('file');
});
