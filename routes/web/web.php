<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('welcome');

Route::get('/dashboard', fn () => redirect('/cms'))->name('dashboard');

// Logs
Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('logs')->middleware('auth', 'role:superadmin');

// Require additional route files
require 'auth.php';
require 'profile.php';
