<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Traits\WithReturnResponse;

abstract class Controller
{
    use WithReturnResponse;
}
