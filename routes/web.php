<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => to_route('cms.dashboard'))->name('dashboard');

require __DIR__.'/cms/index.php';
require __DIR__.'/auth/index.php';
