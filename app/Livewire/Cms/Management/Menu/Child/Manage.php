<?php

namespace App\Livewire\Cms\Management\Menu\Child;

use App\Livewire\Forms\Cms\Management\FormMenuChild;
use App\Enums\Alert;
use App\Models\Menu;
use BaseComponent;
use Override;

class Manage extends BaseComponent
{
    public FormMenuChild $form;
    public $title = 'Menu Child';
    public $isUpdate = false;
    public $menu;

    public function mount($menu, $id = null) {
        $this->menu = Menu::find($menu);

        // Check menu exist
        if(!$this->menu) return $this->redirectRoute('cms.management.menu');

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
        return view('livewire.cms.management.menu.child.manage')->title($this->title);
    }

    #[Override]
    public function save($redirect = null, $navigate = true) {
        $this->form->menu_id = $this->menu->id;
        $this->form->save();

        session()->flash(Alert::success->value, $this->isUpdate ? 'Data Updated' : 'Data Created');

        $redirect = substr($this->originRoute, 0, -7);

        // Check route is exists
        $this->redirectRoute($redirect, ['menu' => $this->menu->id], navigate: $navigate);
    }
}
