<?php

namespace App\Traits;

use App\Enums\Alert;

trait WithSaveAction {
    public function save() {
        // try {
        $this->form->save();

        // Image iteration to prevent duplicate image
        $this->imageIttr++;

        $this->dispatch('closeModal', modal: 'acc-modal');
        $this->dispatch('alert', type: Alert::success, message: $this->isUpdate ? 'Data Updated' : 'Data Created');
        // } catch (\Exception $exception) {
        //     $this->dispatch('alert', type: Alert::error, message: $exception->getMessage());
        // }
    }
}
