<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth:api'],
], function () {
    // Users Routes
    Route::get('/users', [App\Http\Controllers\Api\V1\User\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{model}', [App\Http\Controllers\Api\V1\User\UserController::class, 'show'])->name('users.show');
    Route::post('/users', [App\Http\Controllers\Api\V1\User\UserController::class, 'store'])->name('users.store');
    Route::put('/users/{model}', [App\Http\Controllers\Api\V1\User\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{model}', [App\Http\Controllers\Api\V1\User\UserController::class, 'destroy'])->name('users.destroy');

    // Teachers Routes
    Route::get('/teachers', [App\Http\Controllers\Api\V1\User\TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/{model}', [App\Http\Controllers\Api\V1\User\TeacherController::class, 'show'])->name('teachers.show');
    Route::post('/teachers', [App\Http\Controllers\Api\V1\User\TeacherController::class, 'store'])->name('teachers.store');
    Route::put('/teachers/{model}', [App\Http\Controllers\Api\V1\User\TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{model}', [App\Http\Controllers\Api\V1\User\TeacherController::class, 'destroy'])->name('teachers.destroy');

    // Students Routes
    Route::get('/students', [App\Http\Controllers\Api\V1\User\StudentController::class, 'index'])->name('students.index');
    Route::get('/students/{model}', [App\Http\Controllers\Api\V1\User\StudentController::class, 'show'])->name('students.show');
    Route::post('/students', [App\Http\Controllers\Api\V1\User\StudentController::class, 'store'])->name('students.store');
    Route::put('/students/{model}', [App\Http\Controllers\Api\V1\User\StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{model}', [App\Http\Controllers\Api\V1\User\StudentController::class, 'destroy'])->name('students.destroy');

    // Guardians Routes
    Route::get('/guardians', [App\Http\Controllers\Api\V1\User\GuardianController::class, 'index'])->name('guardians.index');
    Route::get('/guardians/{model}', [App\Http\Controllers\Api\V1\User\GuardianController::class, 'show'])->name('guardians.show');
    Route::post('/guardians', [App\Http\Controllers\Api\V1\User\GuardianController::class, 'store'])->name('guardians.store');
    Route::put('/guardians/{model}', [App\Http\Controllers\Api\V1\User\GuardianController::class, 'update'])->name('guardians.update');
    Route::delete('/guardians/{model}', [App\Http\Controllers\Api\V1\User\GuardianController::class, 'destroy'])->name('guardians.destroy');
});
