<?php

namespace App\Traits;

use App\Enums\Alert;
use Spatie\Permission\Exceptions\UnauthorizedException;

trait WithSaveAction {
    public function save() {
        try {
            // Check permission
            $permission = $this->isUpdate ? 'update.' : 'create.';

            // Check permission
            if(!auth()->user()->can($permission . $this->originRoute)) throw new UnauthorizedException(403, 'You do not have permission.');

            $this->form->save();

            session()->flash(Alert::success->value, $this->isUpdate ? 'Data Updated' : 'Data Created');

            // Redirect
            $this->closeModal();
        } catch (UnauthorizedException $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
