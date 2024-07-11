<?php

namespace App\Traits;

use App\Enums\Alert;

trait WithSaveAction {
    public function save($modal = 'acc-modal') {
        $this->form->save();

        // Image iteration to prevent duplicate image
        $this->imageIttr++;

        $this->dispatch('closeModal', modal: $modal);
        $this->dispatch('alert', type: Alert::success, message: $this->isUpdate ? 'Data Updated' : 'Data Created');
    }
}
