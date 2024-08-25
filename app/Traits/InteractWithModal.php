<?php

namespace App\Traits;

trait InteractWithModal {
    public $modals = [
        'defaultModal' => false,
    ];

    public function addModal(string $modal) {
        $this->modals[$modal] = false;
    }

    public function openModal(string $modal = 'defaultModal') {
        $this->modals[$modal] = true;
    }

    public function closeModal(string $modal = 'defaultModal') {
        $this->modals[$modal] = false;
    }
}
