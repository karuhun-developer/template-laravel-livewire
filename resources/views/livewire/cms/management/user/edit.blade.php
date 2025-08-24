<?php

use App\Livewire\BaseComponent;
use App\Models\Spatie\Role;
use App\Models\User;

new class extends BaseComponent {
    public string $title = 'Edit User';
    public string $description = 'Edit an existing user for the system.';
    public string $modelInstance = User::class;
    public $model;

    public function mount(User $model) {
        $this->canDo('update.' . $this->modelInstance);

        $this->model = $model;

        // Set properties from the old data
        $this->name = $this->model->name;
        $this->email = $this->model->email;
        $this->role = $this->model->getRoleNames()[0];

        $this->roles = Role::all();
    }

    // Define roles for the user update
    public $roles = [];

    // Properties for user update
    public string $role;
    public string $name;
    public string $email;

    public function save() {
        $this->validate([
            'role' => 'required|exists:roles,name',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->model->id,
        ]);

        // Update the existing user with the validated name
        $this->model->syncRoles([$this->role]);
        $this->model->update($this->all());

        // Redirect to the user index page after update
        to_route('cms.management.user')->with('success', 'User updated successfully.');
    }
}; ?>

<div>
    <x-acc-back url="{{ route('cms.management.user')  }}" />
    <div class="row">
        <div class="col-12">
            <div class="card my-3">
                <div class="card-header">
                    <div class="d-lg-flex">
                        <div>
                            <h5 class="mb-0">
                                {{ $title }}
                            </h5>
                            <p class="text-sm mb-0">
                                {{ $description }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-4">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <x-acc-input model="name" label="Name" :filled="true" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <x-acc-input type="email" model="email" label="Email" :filled="true" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">
                                    Role
                                </label>
                                <x-acc-input type="select" model="role">
                                    <option value="">-- Select Role --</option>
                                    @foreach($roles as $r)
                                        <option value="{{ $r->name }}">{{ $r->name }}</option>
                                    @endforeach
                                </x-acc-input>
                            </div>
                        </div>
                        <div class="float-start">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-save me-2"></i>
                                Save
                            </button>
                            <a href="{{ route('cms.management.user') }}" class="btn bg-gradient-dark btn-sm me-2">
                                <i class="fas fa-arrow-left me-2"></i>
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
