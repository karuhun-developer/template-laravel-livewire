<?php

namespace App\Livewire\Cms\Management\Menu;

use App\Livewire\Forms\Cms\Management\FormMenu;
use BaseComponent;

class Manage extends BaseComponent
{
    public FormMenu $form;
    public $title = 'Menu';
    public $isUpdate = false;

    public function mount($id = null) {
        // If id exists
        if($id) {
            $this->title = 'Update ' . $this->title;
            $this->isUpdate = true;
            $this->form->getDetail($id);

            // If meta is null
            if($this->form->meta == null) {
                $this->form->meta = [
                    'description' => '',
                    'keywords' => '',
                ];
            }
        } else {
            $this->title = 'Create ' . $this->title;
            $this->isUpdate = false;
            $this->form->meta = [
                'description' => '',
                'keywords' => '',
            ];
        }
    }

    public function render()
    {
        return view('livewire.cms.management.menu.manage')->title($this->title);
    }
}
