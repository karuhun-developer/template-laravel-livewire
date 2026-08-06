<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders recovery-codes and loads existing codes', function () {
    $user = User::factory()->create([
        'two_factor_secret' => encrypt('test-secret'),
        'two_factor_recovery_codes' => encrypt(json_encode(['code-one', 'code-two'])),
    ]);

    $this->actingAs($user);

    Livewire::test('setting.two-factor.recovery-codes')
        ->assertStatus(200)
        ->assertSet('recoveryCodes', ['code-one', 'code-two']);
});

it('regenerates recovery codes', function () {
    $user = User::factory()->create([
        'two_factor_secret' => encrypt('test-secret'),
        'two_factor_recovery_codes' => encrypt(json_encode(['code-one', 'code-two'])),
    ]);

    $this->actingAs($user);

    $component = Livewire::test('setting.two-factor.recovery-codes')
        ->call('regenerateRecoveryCodes')
        ->assertHasNoErrors();

    expect($component->get('recoveryCodes'))->toHaveCount(8);
});
