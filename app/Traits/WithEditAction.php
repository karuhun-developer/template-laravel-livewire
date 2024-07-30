<?php

namespace App\Traits;

use App\Enums\Alert;
use Spatie\Permission\Exceptions\UnauthorizedException;

trait WithEditAction {
    public function edit($id) {
        try {
            // Check permission
            if(!auth()->user()->can('update.' . $this->originRoute)) throw new UnauthorizedException(403, 'You do not have permission.');

            $this->isUpdate = true;

            $this->form->getDetail($id);

            $this->openModal();
        } catch (UnauthorizedException $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
