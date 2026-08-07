<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('renders appearance successfully', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('setting.appearance')->assertStatus(200);
});
