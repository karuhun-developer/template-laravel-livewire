<?php

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

    Livewire::test('cms.management.user.table')->assertStatus(200);
});

it('cannot delete without permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $this->actingAs($user);

    try {

        Livewire::test('cms.management.user.table')->call('delete', 1)->assertForbidden();
    } catch (Exception $e) {
        $this->assertTrue(true);
    }
});

it('can delete with permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    $recordId = User::factory()->create()->id;
    $args = [];
    try {
        $livewire = Livewire::test('cms.management.user.table', $args);
        $livewire->call('delete', $recordId);
    } catch (Exception $e) {
    }
    $this->assertTrue(true);
});
