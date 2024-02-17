<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cms',
    'as' => 'cms.',
    'middleware' => ['auth', 'validate-role-permission'],
], function () {

    Route::get('/', App\Livewire\Dashboard::class)->name('dashboard');

    // Management
    Route::get('/management/menu', App\Livewire\Cms\Management\Menu::class)->name('management.menu');
    Route::get('/management/role', App\Livewire\Cms\Management\Role::class)->name('management.role');
    Route::get('/management/role-permission/{role?}', App\Livewire\Cms\Management\RolePermission::class)->name('management.role-permission');
    Route::get('/management/user', App\Livewire\Cms\Management\User::class)->name('management.user');
    Route::get('/management/website', App\Livewire\Cms\Management\Setting::class)->name('management.setting');
    Route::get('/management/access-control', App\Livewire\Cms\Management\AccessControl::class)->name('management.access-control');
    Route::get('/management/privacy-policy', App\Livewire\Cms\Management\PrivacyPolicy::class)->name('management.privacy-policy');
    Route::get('/management/terms-of-service', App\Livewire\Cms\Management\TermOfService::class)->name('management.term-of-service');
});
