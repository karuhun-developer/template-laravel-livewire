<?php

namespace App\Traits;

trait WithResetAction {
    public function resetAll() {
        $oldId = $this->form->id;
        $this->form->reset();

        // If the old id is not null, set it back
        if($oldId) {
            $this->form->id = $oldId;
            $this->form->getDetail($oldId);
        }
    }
}
