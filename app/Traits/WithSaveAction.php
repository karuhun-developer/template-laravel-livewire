<?php

namespace App\Traits;

use App\Enums\Alert;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Illuminate\Support\Facades\Route;

trait WithSaveAction {
    public function save($redirect = null, $navigate = true) {
        try {
            // Check permission
            $permission = $this->isUpdate ? 'update.' : 'create.';

            // If redirect is null
            if($redirect) {
                // Check permission
                if(!auth()->user()->can($permission . $this->originRoute)) throw new UnauthorizedException(403, 'You do not have permission.');
            } else {
                // Delete the .manage from route
                $redirect = substr($this->originRoute, 0, -7);

                // Check permission
                if(!auth()->user()->can($permission . $redirect)) throw new UnauthorizedException(403, 'You do not have permission.');
            }

            $this->form->save();

            session()->flash(Alert::success->value, $this->isUpdate ? 'Data Updated' : 'Data Created');

            // Redirect
            if($redirect) {
                $this->redirectRoute($redirect, navigate: $navigate);
            } else {
                // Check route is exists
                if(Route::has($redirect)) $this->redirectRoute($redirect, navigate: $navigate);

                // Default
                $this->redirect($this->previousUrl, navigate: $navigate);
            }
        } catch (UnauthorizedException $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
