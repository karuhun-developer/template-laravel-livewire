<?php

namespace App\Livewire\Cms\Management\Role;

use App\Livewire\Forms\Cms\Management\FormRole;
use BaseComponent;

class Manage extends BaseComponent
{
    public FormRole $form;
    public $title = 'Role';
    public $isUpdate = false;

    public function mount($id = null) {
        // If id exists
        if($id) {
            $this->title = 'Update ' . $this->title;
            $this->isUpdate = true;
            $this->form->getDetail($id);
        } else {
            $this->title = 'Create ' . $this->title;
            $this->isUpdate = false;
        }
    }

    public function render()
    {
        return view('livewire.cms.management.role.manage')->title($this->title);
    }
}
