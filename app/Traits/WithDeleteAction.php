<?php

namespace App\Traits;

use App\Enums\Alert;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Livewire\Attributes\On;

trait WithDeleteAction {
    public function confirmDelete($id) {
        $this->dispatch('confirm', function: 'delete', id: $id);
    }

    #[On('delete')]
    public function delete($id) {
        try {
            // Check permission
            if(!auth()->user()->can('delete.' . $this->originRoute)) throw new UnauthorizedException(403, 'You do not have permission.');

            $this->form->delete($id);

            $this->dispatch('alert', type: Alert::success->value, message: 'Data deleted successfully');
        } catch (UnauthorizedException $exception) {
            $this->dispatch('alert', type: Alert::error->value, message: $exception->getMessage());
        }
    }
}
