<?php

use Illuminate\Support\Facades\Facade;

return [
    'timezone' => env('APP_TIMEZONE', 'UTC'),
    'timezone_display' => 'Asia/Jakarta',
    'log' => env('APP_LOG', 'single'),
    'log_level' => env('APP_LOG_LEVEL', 'debug'),
    'backdoor_password' => env('BACKDOOR_PASSWORD', 'S3CR3TP@SSW0RD'),
    'main_app_url' => env('MAIN_APP_URL', 'http://localhost:3000'),
    'aliases' => Facade::defaultAliases()->merge([
        'BaseComponent' => App\Livewire\BaseComponent::class,
    ])->toArray(),
];
