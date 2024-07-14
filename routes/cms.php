<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cms',
    'as' => 'cms.',
    'middleware' => ['auth', 'validate-role-permission'],
], function () {

    Route::get('/', App\Livewire\Dashboard::class)->name('dashboard');
    Route::get('/ggwp', App\Livewire\Dashboard::class)->name('dashboard.ggwp');

    // Management Menu
    Route::get('/management/menu', App\Livewire\Cms\Management\Menu\Index::class)->name('management.menu');
    Route::get('/management/menu/manage/{id?}', App\Livewire\Cms\Management\Menu\Manage::class)->name('management.menu.manage');

    // Management Menu Child
    Route::get('/management/menu/{menu}', App\Livewire\Cms\Management\Menu\Child\Index::class)->name('management.menu.child');
    Route::get('/management/menu/{menu}/manage/{id?}', App\Livewire\Cms\Management\Menu\Child\Manage::class)->name('management.menu.child.manage');

    // Management Role
    Route::get('/management/role', App\Livewire\Cms\Management\Role\Index::class)->name('management.role');
    Route::get('/management/role/manage/{id?}', App\Livewire\Cms\Management\Role\Manage::class)->name('management.role.manage');
    Route::get('/management/role-permission/{role?}', App\Livewire\Cms\Management\Role\Permission::class)->name('management.role-permission');

    // Management User
    Route::get('/management/user', App\Livewire\Cms\Management\User\Index::class)->name('management.user');
    Route::get('/management/user/manage/{id?}', App\Livewire\Cms\Management\User\Manage::class)->name('management.user.manage');

    // Access Control
    Route::get('/management/access-control', App\Livewire\Cms\Management\AccessControl::class)->name('management.access-control');

    // Setting
    Route::get('/management/setting-general', App\Livewire\Cms\Management\Setting\General::class)->name('management.general-setting');
    Route::get('/management/setting-misc', App\Livewire\Cms\Management\Setting\Misc::class)->name('management.misc-setting');
    Route::get('/management/setting-mail', App\Livewire\Cms\Management\Setting\Mail::class)->name('management.mail-setting');
    Route::get('/management/setting-privacy-policy', App\Livewire\Cms\Management\Setting\PrivacyPolicy::class)->name('management.privacy-policy-setting');
    Route::get('/management/setting-terms-of-service', App\Livewire\Cms\Management\Setting\TermOfService::class)->name('management.term-of-service-setting');
});
