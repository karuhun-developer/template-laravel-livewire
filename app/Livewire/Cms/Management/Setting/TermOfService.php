<?php

namespace App\Livewire\Cms\Management\Setting;

use App\Livewire\Forms\Cms\Management\Setting\FormTermOfService;
use BaseComponent;

class TermOfService extends BaseComponent
{
    public FormTermOfService $form;
    public $title = 'Terms of Service';
    public $isUpdate = true;
    public $trix = '';

    public function mount() {
        $this->form->getData();
        $this->trix = $this->form->term_of_service;
    }

    public function render()
    {
        return view('livewire.cms.management.setting.term-of-service')->title($this->title);
    }

    public function customSave() {
        $this->form->term_of_service = $this->trix;
        $this->save();
    }
}
