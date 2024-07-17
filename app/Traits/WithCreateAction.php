<?php

namespace App\Traits;

use App\Enums\Alert;
trait WithCreateAction {
    public function create($navigate = true) {
        try {
            // Check permission
            if(!auth()->user()->can('create.' . $this->originRoute)) throw new \Exception('Unauthorized');

            $this->redirectRoute($this->originRoute . '.manage', navigate: $navigate);
        } catch (\Exception $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
