<?php

namespace App\Livewire\Cms\Management\Setting;

use App\Livewire\Forms\Cms\Management\Setting\FormTermOfService;
use BaseComponent;

class TermOfService extends BaseComponent
{
    public FormTermOfService $form;
    public $title = 'Term Of Service';

    public function mount() {
        $this->isUpdate = true;
        $this->form->getData();
    }

    public function render()
    {
        return view('livewire.cms.management.setting.term-of-service')->title($this->title);
    }
}

