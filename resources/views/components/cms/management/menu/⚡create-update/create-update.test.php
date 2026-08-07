<?php

declare(strict_types=1);

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

    Livewire::test('cms.management.menu.create-update')->assertStatus(200);
});

it('validates empty inputs on submit', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $user->assignRole('superadmin');
    $this->actingAs($user);

    Livewire::test('cms.management.menu.create-update')->call('submit')->assertHasErrors();
});

it('cannot access setAction without show permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $this->actingAs($user);

    Livewire::test('cms.management.menu.create-update')->call('setAction', 1)->assertForbidden();
});

it('cannot submit without create/update permission', function () {
    $user = User::factory()->create();
    $this->seed(PermissionSeeder::class);
    $this->actingAs($user);

    Livewire::test('cms.management.menu.create-update')->call('submit')->assertForbidden();
});
