<?php

namespace App\Http\Controllers;

use App\Traits\WithReturnResponse;

abstract class Controller
{
    use WithReturnResponse;

    protected function authorize(string $ability, mixed $arguments = null): void
    {
        if (! auth()->user()?->can($ability, $arguments)) {
            throw new \Illuminate\Auth\Access\AuthorizationException('This action is unauthorized.', 403);
        }
    }
}
