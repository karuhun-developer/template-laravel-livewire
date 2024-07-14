<?php

namespace App\Traits;

use App\Enums\Alert;
use Illuminate\Support\Facades\Route;

trait WithSaveAction {
    public function save($redirect = null, $navigate = true) {
        $this->form->save();

        session()->flash(Alert::success->value, $this->isUpdate ? 'Data Updated' : 'Data Created');

        // Redirect
        if($redirect) {
            $this->redirectRoute($redirect, navigate: $navigate);
        } else {
            $redirect = substr($this->originRoute, 0, -7);

            // Check route is exists
            if(Route::has($redirect)) $this->redirectRoute($redirect, navigate: $navigate);
        }
    }
}
