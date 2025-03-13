<?php

namespace App\Livewire\Cms\Management\Setting;

use App\Livewire\Forms\Cms\Management\Setting\FormMisc;
use BaseComponent;

class Misc extends BaseComponent
{
    public FormMisc $form;
    public $title = 'Misc Setting';

    public function mount() {
        $this->isUpdate = true;
        $this->form->getData();
    }

    public function render()
    {
        return view('livewire.cms.management.setting.misc')->title($this->title);
    }
}
