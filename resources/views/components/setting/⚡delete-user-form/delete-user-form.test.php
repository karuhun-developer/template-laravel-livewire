<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders delete-user-form successfully', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('setting.delete-user-form')->assertStatus(200);
});

it('deletes the account with the correct password', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('setting.delete-user-form')
        ->set('password', 'password')
        ->call('deleteUser')
        ->assertHasNoErrors()
        ->assertRedirect('/');

    expect($user->fresh())->toBeNull();
    expect(auth()->check())->toBeFalse();
});

it('requires the correct password to delete the account', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('setting.delete-user-form')
        ->set('password', 'wrong-password')
        ->call('deleteUser')
        ->assertHasErrors(['password']);

    expect($user->fresh())->not->toBeNull();
});
