<?php

use App\Models\Menu\Menu;
use App\Models\Menu\MenuSub;
use App\Models\Spatie\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders table successfully', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    Livewire::test('cms.management.menu.sub.table', ['menu' => $menu])->assertStatus(200);
});

it('cannot delete without permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->givePermissionTo('view'.MenuSub::class);
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    Livewire::test('cms.management.menu.sub.table', ['menu' => $menu])->call('delete', 1)->assertForbidden();
});

it('can delete with permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    $menuSub = MenuSub::create(['role_id' => $role->id, 'menu_id' => $menu->id, 'name' => 'Sub', 'url' => '/sub', 'order' => 1, 'status' => 1]);
    $recordId = $menuSub->id;
    $args = ['menu' => $menu];
    Livewire::test('cms.management.menu.sub.table', $args)
        ->call('delete', $recordId)
        ->assertHasNoErrors();
});
