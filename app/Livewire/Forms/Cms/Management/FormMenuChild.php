<?php

namespace App\Livewire\Forms\Cms\Management;

use App\Livewire\Contracts\FormCrudInterface;
use App\Models\MenuChild;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormMenuChild extends Form implements FormCrudInterface
{
    #[Validate('nullable|numeric')]
    public $id;

    #[Validate('required')]
    public $menu_id;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $icon;

    #[Validate('required')]
    public $route;

    #[Validate('required|numeric')]
    public $ordering = 0;

    // Get the data
    public function getDetail($id) {
        $data = MenuChild::find($id);

        $this->id = $id;
        $this->menu_id = $data->id;
        $this->name = $data->name;
        $this->icon = $data->icon;
        $this->route = $data->route;
        $this->ordering = $data->ordering;
    }

    // Save the data
    public function save() {
        $this->validate();

        if ($this->id) {
            $this->update();
        } else {
            $this->store();
        }

        $this->reset();
    }

    // Store data
    public function store() {
        MenuChild::create($this->only([
            'menu_id',
            'name',
            'icon',
            'route',
            'ordering',
        ]));
    }

    // Update data
    public function update() {
        MenuChild::find($this->id)->update($this->all());
    }

    // Delete data
    public function delete($id) {
        MenuChild::find($id)->delete();
    }
}
