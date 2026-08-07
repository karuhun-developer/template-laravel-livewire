<?php

declare(strict_types=1);

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

it('can check all permissions', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $role = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'api']);
    Livewire::test('cms.management.role.permission', ['role' => $role])
        ->call('checkAll')
        ->assertHasNoErrors();
});
