<?php

use App\Livewire\BaseComponent;
use App\Models\Spatie\Role;

new class extends BaseComponent {
    public string $title = 'Edit Role';
    public string $description = 'Edit an existing role for the system.';
    public string $model = Role::class;
    public $oldData;

    public function mount($id) {
        $this->canDo('update.' . $this->model);

        $this->oldData = Role::find($id);
        if (!$this->oldData) to_route('cms.management.role')->with('error', 'Role not found.');

        // Set properties from the old data
        $this->name = $this->oldData->name;
        $this->guard_name = $this->oldData->guard_name;
    }

    // Properties for role creation
    public string $name;
    public string $guard_name = 'web';

    public function save() {
        $this->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $this->oldData->id,
            'guard_name' => 'required|string|max:255|in:web,api',
        ]);

        // Create a new role with the validated name
        Role::create($this->all());

        // Redirect to the role index page after creation
        to_route('cms.management.role')->with('success', 'Role updated successfully.');
    }
}; ?>

<div>
    <x-acc-back url="{{ route('cms.management.role')  }}" />
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
                                <label class="form-label fw-bold">
                                    Guard Name
                                </label>
                                <x-acc-input type="select" model="guard_name">
                                    <option value="">-- Select Guard --</option>
                                    <option value="web">Web</option>
                                    <option value="api">API</option>
                                </x-acc-input>
                            </div>
                        </div>
                        <div class="float-start">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-save me-2"></i>
                                Save
                            </button>
                            <a href="{{ route('cms.management.role') }}" class="btn bg-gradient-dark btn-sm me-2">
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
