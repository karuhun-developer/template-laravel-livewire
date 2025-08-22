<?php

use App\Livewire\BaseComponent;
use App\Models\Spatie\Permission;

new class extends BaseComponent {
    public string $title = 'Edit Permission';
    public string $description = 'Edit an existing permission for the system.';
    public string $model = Permission::class;
    public $oldData;

    public function mount($id) {
        $this->canDo('update.' . $this->model);

        $this->oldData = Permission::find($id);
        if (!$this->oldData) to_route('cms.management.permission')->with('error', 'Permission not found.');

        // Set properties from the old data
        $this->name = $this->oldData->name;
        $this->guard_name = $this->oldData->guard_name;
    }

    // Properties for permission creation
    public string $name;
    public string $guard_name = 'web';

    public function save() {
        $this->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $this->oldData->id,
            'guard_name' => 'required|string|max:255|in:web,api',
        ]);

        // Create a new permission with the validated name
        $this->oldData->update($this->all());

        // Redirect to the permission index page after creation
        to_route('cms.management.permission')->with('success', 'Permission updated successfully.');
    }
}; ?>

<div>
    <x-acc-back url="{{ route('cms.management.permission')  }}" />
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
                            <a href="{{ route('cms.management.permission') }}" class="btn bg-gradient-dark btn-sm me-2">
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
