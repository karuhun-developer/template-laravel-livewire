<?php

use App\Models\Menu\Menu;
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

    Livewire::test('cms.management.menu.table')->assertStatus(200);
});

it('cannot delete without permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->givePermissionTo('view'.Menu::class);
    $this->actingAs($user);

    Livewire::test('cms.management.menu.table')->call('delete', 1)->assertForbidden();
});

it('can delete with permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    $menu = Menu::create(['role_id' => $role->id, 'name' => 'Menu', 'url' => '/menu', 'order' => 1, 'status' => 1]);
    $recordId = $menu->id;
    $args = [];
    Livewire::test('cms.management.menu.table', $args)
        ->call('delete', $recordId)
        ->assertHasNoErrors();
});
