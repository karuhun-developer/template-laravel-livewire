<?php

namespace App\Traits;

use App\Enums\Alert;

trait WithEditAction {
    public function edit($id, $navigate = true) {
        try {
            // Check permission
            if(!auth()->user()->can('update.' . $this->originRoute)) throw new \Exception('Unauthorized');

            $this->redirectRoute($this->originRoute . '.manage', [
                'id' => $id,
            ], navigate: $navigate);
        } catch (\Exception $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
