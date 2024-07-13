<?php

namespace App\Livewire\Cms\Management\User;

use App\Livewire\Forms\Cms\Management\FormUser;
use Spatie\Permission\Models\Role;
use BaseComponent;

class Manage extends BaseComponent
{
    public FormUser $form;
    public $title = 'User';
    public $isUpdate = false;

    public $roles = [];

    public function mount($id = null) {
        $this->roles = Role::all();
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
        return view('livewire.cms.management.user.manage')->title($this->title);
    }
}
