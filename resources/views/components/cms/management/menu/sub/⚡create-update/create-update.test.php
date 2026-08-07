<?php

declare(strict_types=1);

use App\Models\Menu\Menu;
use App\Models\Spatie\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders create-update successfully', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    Livewire::test('cms.management.menu.sub.create-update', ['menu' => $menu])->assertStatus(200);
});

it('validates empty inputs on submit', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    Livewire::test('cms.management.menu.sub.create-update', ['menu' => $menu])->call('submit')->assertHasErrors();
});

it('cannot access setAction without show permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    Livewire::test('cms.management.menu.sub.create-update', ['menu' => $menu])->call('setAction', 1)->assertForbidden();
});

it('cannot submit without create/update permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    Livewire::test('cms.management.menu.sub.create-update', ['menu' => $menu])->call('submit')->assertForbidden();
});
