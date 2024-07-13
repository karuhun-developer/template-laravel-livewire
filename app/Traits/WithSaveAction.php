<?php

namespace App\Traits;

use App\Enums\Alert;

trait WithSaveAction {
    public function save($redirect = null, $navigate = true) {
        $this->form->save();

        session()->flash(Alert::success->value, $this->isUpdate ? 'Data Updated' : 'Data Created');

        // Redirect
        if($redirect) {
            $this->redirectRoute($redirect, navigate: $navigate);
        } else {
            $this->redirectRoute(substr($this->originRoute, 0, -7), navigate: $navigate);
        }
    }
}
