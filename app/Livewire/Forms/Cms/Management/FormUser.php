<?php

namespace App\Livewire\Forms\Cms\Management;

use App\Livewire\Contracts\FormCrudInterface;
use App\Models\User;
use Livewire\Form;

class FormUser extends Form implements FormCrudInterface
{
    public $id;

    public $role;

    public $name;

    public $email;

    public $password;

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
        if ($this->id) {
            $this->update();
        } else {
            $this->store();
        }

        $this->reset();
    }

    // Store data
    public function store() {
        $this->validate([
            'id' => 'nullable',
            'role' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|unique:users,email',
        ]);

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
        $this->validate([
            'id' => 'required',
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $this->id,
        ]);

        $user = User::find($this->id);

        // Remove all role
        $user->syncRoles([]);

        // Assign new role
        $user->assignRole($this->role);
        $user->update($this->only([
            'name',
            'email',
        ]));
    }

    // Delete data
    public function delete($id) {
        User::find($id)->delete();
    }

    // Change password
    public function changePassword() {
        User::find($this->id)->update([
            'password' => $this->password,
        ]);
    }
}
