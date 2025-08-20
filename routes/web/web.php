<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'))->name('welcome');

Route::get('/dashboard', fn () => 'Dashboard')->middleware(['auth'])->name('dashboard');

// Require additional route files
require 'auth.php';
require 'profile.php';

// CMS routes
require 'cms/index.php';
