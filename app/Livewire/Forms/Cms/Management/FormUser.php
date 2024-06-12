<?php

namespace App\Livewire\Forms\Cms\Management;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class FormUser extends Form
{
    #[Validate('nullable|numeric')]
    public $id = '';

    #[Validate('required')]
    public $role = '';

    #[Validate('required')]
    public $name = '';

    #[Validate('required|email')]
    public $email = '';

    #[Validate('required')]
    public $password = '';

    // Get the data
    public function getDetail($id) {
        $data = User::find($id);

        $this->id = $id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->getRoleNames()[0];
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
        $user = User::create($this->only([
            'name',
            'email',
            'password',
        ]));

        // Assign new role
        $user->assignRole($this->role);
    }

    // Update data
    public function update() {
        $user = User::find($this->id);

        // Remove all role
        $user->syncRoles([]);

        // Assign new role
        $user->assignRole($this->role);
        $user->update($this->only([
            'name',
            'email',
            'password',
        ]));
    }

    // Delete data
    public function delete($id) {
        User::find($id)->delete();
    }
}
