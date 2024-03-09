<?php

namespace App\Traits;

trait WithResetAction {
    public function resetAll() {
        $oldId = $this->form->id;
        $this->form->reset();
        $this->form->id = $oldId;
    }
}
