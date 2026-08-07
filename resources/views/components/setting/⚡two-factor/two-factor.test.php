<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Fortify\Features;
use Livewire\Livewire;

uses(RefreshDatabase::class);

beforeEach(function () {
    if (! Features::canManageTwoFactorAuthentication()) {
        $this->markTestSkipped('Two-factor authentication is not enabled.');
    }

    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]);
});

it('renders two-factor successfully', function () {
    $user = User::factory()->withoutTwoFactor()->create();

    $this->actingAs($user);

    Livewire::test('setting.two-factor')
        ->assertStatus(200)
        ->assertSet('twoFactorEnabled', false);
});

it('disables two factor when confirmation is abandoned', function () {
    $user = User::factory()->create([
        'two_factor_secret' => encrypt('test-secret'),
        'two_factor_recovery_codes' => encrypt(json_encode(['code1', 'code2'])),
        'two_factor_confirmed_at' => null,
    ]);

    $this->actingAs($user);

    Livewire::test('setting.two-factor')
        ->assertSet('twoFactorEnabled', false);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'two_factor_secret' => null,
        'two_factor_recovery_codes' => null,
    ]);
});
