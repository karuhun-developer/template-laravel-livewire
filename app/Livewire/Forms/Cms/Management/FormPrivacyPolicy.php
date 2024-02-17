<?php

namespace App\Livewire\Forms\Cms\Management;

use App\Models\Setting;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormPrivacyPolicy extends Form
{
    #[Validate('required')]
    public $privacy_policy = '';

    public function getData() {
        $setting = Setting::first();

        $this->privacy_policy = $setting->privacy_policy;
    }

    public function save() {
        $this->validate();

        Setting::first()->update([
            'privacy_policy' => $this->privacy_policy,
        ]);

        $this->getData();
    }
}
