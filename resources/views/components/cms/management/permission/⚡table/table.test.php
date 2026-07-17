<?php

use App\Models\Spatie\Permission;
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

    Livewire::test('cms.management.permission.table')->assertStatus(200);
});

it('cannot delete without permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->givePermissionTo('view'.Permission::class);
    $this->actingAs($user);

    Livewire::test('cms.management.permission.table')->call('delete', 1)->assertForbidden();
});

it('can delete with permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $recordId = 1;
    $args = [];
    Livewire::test('cms.management.permission.table', $args)
        ->call('delete', $recordId)
        ->assertHasNoErrors();
});
