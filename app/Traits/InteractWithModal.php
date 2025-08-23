<?php

namespace App\Traits;

trait InteractWithModal {
    public $modals = [
        'acc-modal' => false,
    ];

    public function addModal(string $modal) {
        $this->modals[$modal] = false;
    }

    public function openModal(string $modal = 'acc-modal') {
        $this->modals[$modal] = true;
    }

    public function closeModal(string $modal = 'acc-modal') {
        $this->modals[$modal] = false;
    }
}
