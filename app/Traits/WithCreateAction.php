<?php

namespace App\Traits;

use App\Enums\Alert;
use Spatie\Permission\Exceptions\UnauthorizedException;
trait WithCreateAction {
    public function create($navigate = true) {
        try {
            // Check permission
            if(!auth()->user()->can('create.' . $this->originRoute)) throw new UnauthorizedException(403, 'You do not have permission.');

            $this->redirectRoute($this->originRoute . '.manage', navigate: $navigate);
        } catch (UnauthorizedException $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
