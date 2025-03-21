<?php

namespace App\Traits;

use Livewire\Attributes\Renderless;

trait InteractWithModal {
    public $modals = [
        'defaultModal' => false,
    ];

    public function addModal(string $modal) {
        $this->modals[$modal] = false;
    }

    #[Renderless]
    public function openModal(string $modal = 'defaultModal') {
        $this->modals[$modal] = true;
    }

    #[Renderless]
    public function closeModal(string $modal = 'defaultModal') {
        $this->modals[$modal] = false;
    }
}
