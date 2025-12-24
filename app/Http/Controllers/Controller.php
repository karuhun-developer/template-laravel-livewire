<?php

namespace App\Http\Controllers;

use App\Traits\WithReturnResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use WithReturnResponse, AuthorizesRequests;
}
