<?php

namespace App\Traits;

use App\Enums\Alert;
use Livewire\Attributes\On;

trait WithDeleteAction {
    public function confirmDelete($id) {
        $this->dispatch('confirm', function: 'delete', id: $id);
    }

    #[On('delete')]
    public function delete($id) {
        try {
            $this->form->delete($id);
            $this->dispatch('alert', type: Alert::success, message: 'Data deleted successfully');
        } catch (\Exception $exception) {
            $this->dispatch('alert', type: Alert::error, message: $exception->getMessage());
        }
    }
}
