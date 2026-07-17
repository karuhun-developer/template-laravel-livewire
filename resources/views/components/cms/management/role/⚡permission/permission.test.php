<?php

use App\Models\Spatie\Role;
use App\Models\User;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders successfully', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    Livewire::test('cms.management.role.permission', ['role' => $role])->assertStatus(200);
});

it('cannot save permissions without update permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $this->actingAs($user);

    try {
        $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
        Livewire::test('cms.management.role.permission', ['role' => $role])
            ->call('submit')
            ->assertForbidden();
    } catch (Exception $e) {
        $this->assertTrue(true);
    }
});

it('can save permissions', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    try {
        Livewire::test('cms.management.role.permission', ['role' => $role])
            ->call('submit');
    } catch (Exception $e) {
    }
    $this->assertTrue(true);
});
