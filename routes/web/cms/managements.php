<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'managements',
    'as' => 'managements.',
], function () {
    // Managemnet Roles & Permissions
    Route::get('roles', fn () => view('pages.cms.management.role'))->name('roles');
    Route::get('permissions', fn () => view('pages.cms.management.permission'))->name('permissions');
});
