<?php

namespace App\Livewire\Cms\Management\Setting;

use App\Livewire\Forms\Cms\Management\Setting\FormPrivacyPolicy;
use BaseComponent;

class PrivacyPolicy extends BaseComponent
{
    public FormPrivacyPolicy $form;
    public $title = 'Privacy Policy';
    public $isUpdate = true;
    public $trix = '';

    public function mount() {
        $this->form->getData();
        $this->trix = $this->form->privacy_policy;
    }

    public function render()
    {
        return view('livewire.cms.management.setting.privacy-policy')->title($this->title);
    }

    public function customSave() {
        $this->form->privacy_policy = $this->trix;
        $this->save();
    }
}
