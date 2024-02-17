<?php

namespace App\Traits;

trait WithCreateAction {
    public function create() {
        $this->isUpdate = false;
        $this->form->reset();
    }
}
