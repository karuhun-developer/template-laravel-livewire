<?php

namespace App\Traits;

use App\Enums\Alert;
use Spatie\Permission\Exceptions\UnauthorizedException;

trait WithEditAction {
    public function edit($id, $navigate = true) {
        try {
            // Check permission
            if(!auth()->user()->can('update.' . $this->originRoute)) throw new UnauthorizedException(403, 'You do not have permission.');

            $this->redirectRoute($this->originRoute . '.manage', [
                'id' => $id,
            ], navigate: $navigate);
        } catch (UnauthorizedException $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
