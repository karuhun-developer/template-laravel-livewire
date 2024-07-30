<?php

namespace App\Traits;

trait InteractWithModal {
    public function openModal() {
        $this->isModaOpen = true;
    }

    public function closeModal() {
        $this->isModaOpen = false;
    }
}
