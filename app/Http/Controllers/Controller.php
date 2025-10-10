<?php

namespace App\Http\Controllers;

use App\Traits\WithReturnResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, WithReturnResponse;

    protected function authorize($ability, $arguments = null)
    {
        if (!auth()->user()?->can($ability, $arguments)) {
            throw new \Illuminate\Auth\Access\AuthorizationException('This action is unauthorized.', 403);
        }

        return true;
    }
}
