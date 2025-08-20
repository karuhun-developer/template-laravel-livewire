<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cms',
    'as' => 'cms.',
    'middleware' => ['auth'],
], function () {

    // Managements
    require 'managements.php';

    // Logs
    Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs');
});
