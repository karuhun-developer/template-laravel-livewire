<?php

namespace App\Livewire\Forms\Cms\Management;

use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormTermOfService extends Form
{
    #[Validate('required')]
    public $term_of_service = '';

    public function getData() {
        $setting = Setting::first();

        $this->term_of_service = $setting->term_of_service;
    }

    public function save() {
        $this->validate();

        Setting::first()->update([
            'term_of_service' => $this->term_of_service,
        ]);

        $this->getData();
    }
}
