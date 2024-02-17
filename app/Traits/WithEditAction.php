<?php

namespace App\Traits;

trait WithEditAction {
    public function edit($id) {
        $this->isUpdate = true;
        $this->form->getDetail($id);
    }
}
