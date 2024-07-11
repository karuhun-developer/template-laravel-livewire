<?php

namespace App\Livewire\Forms\Cms\Management\Setting;

use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormMisc extends Form
{
    #[Validate('nullable')]
    public $google_analytics;

    public function getData() {
        $data = Setting::first();

        $this->google_analytics = $data->google_analytics;
    }

    public function save() {
        $this->validate();

        Setting::first()->update($this->all());
    }
}
