<?php

namespace App\Livewire\Forms\Cms\Management;

use Spatie\Permission\Models\Role;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormRole extends Form
{
    #[Validate('nullable|numeric')]
    public $id = '';

    #[Validate('required')]
    public $name = '';

    // Get the data
    public function getDetail($id) {
        $data = Role::find($id);

        $this->id = $id;
        $this->name = $data->name;
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
        $data['name'] = $this->name;
        $data['guard_name'] = 'web';

        Role::create($data);
    }

    // Update data
    public function update() {
        Role::find($this->id)->update($this->all());
    }

    // Delete data
    public function delete($id) {
        Role::find($id)->delete();
    }
}
