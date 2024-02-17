<?php

namespace App\Livewire\Cms\Management;

use App\Livewire\Forms\Cms\Management\FormPrivacyPolicy;
use BaseComponent;

class PrivacyPolicy extends BaseComponent
{
    public FormPrivacyPolicy $form;
    public $title = 'Privacy Policy';
    public $isUpdate = true;

    public function mount() {
        $this->form->getData();
    }


    public function render()
    {
        return view('livewire.cms.management.privacy-policy')->title($this->title);
    }
}
