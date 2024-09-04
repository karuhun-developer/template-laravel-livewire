<?php

namespace App\Livewire\Cms\Management\Setting;

use App\Livewire\Forms\Cms\Management\Setting\FormMail;
use BaseComponent;

class Mail extends BaseComponent
{
    public FormMail $form;
    public $title = 'Mail Settings';

    public $isUpdate = true;

    public function mount() {
        $this->form->getData();
    }

    public function render()
    {
        return view('livewire.cms.management.setting.mail')->title($this->title);
    }
}
