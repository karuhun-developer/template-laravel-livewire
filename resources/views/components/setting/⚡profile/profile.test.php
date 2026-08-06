<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders profile successfully', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('setting.profile')->assertStatus(200);
});

it('updates profile information', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('setting.profile')
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->call('updateProfileInformation')
        ->assertHasNoErrors();

    $user->refresh();

    expect($user->name)->toEqual('Test User');
    expect($user->email)->toEqual('test@example.com');
    expect($user->email_verified_at)->toBeNull();
});

it('keeps email verification when email is unchanged', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('setting.profile')
        ->set('name', 'Test User')
        ->set('email', $user->email)
        ->call('updateProfileInformation')
        ->assertHasNoErrors();

    expect($user->refresh()->email_verified_at)->not->toBeNull();
});
