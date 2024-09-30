<?php

use Illuminate\Support\Facades\Facade;

return [
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'timezone_display' => 'Asia/Jakarta',
    'log' => env('APP_LOG', 'single'),
    'log_level' => env('APP_LOG_LEVEL', 'debug'),
    'aliases' => Facade::defaultAliases()->merge([
        'BaseComponent' => App\Livewire\BaseComponent::class,
    ])->toArray(),
];
