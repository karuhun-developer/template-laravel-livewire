<?php

namespace App\Traits;

use App\Enums\Alert;
use Livewire\Attributes\Renderless;
use Spatie\Permission\Exceptions\UnauthorizedException;

trait WithEditAction {
    #[Renderless]
    public function edit($id) {
        try {
            // Check permission
            if(!auth()->user()->can('update.' . $this->originRoute)) throw new UnauthorizedException(403, 'You do not have permission.');

            $this->isUpdate = true;
            $this->isView = false;

            $this->form->getDetail($id);

            $this->openModal();
        } catch (UnauthorizedException $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
