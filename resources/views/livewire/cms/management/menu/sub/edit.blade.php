<?php

use App\Enums\CommonStatusEnum;
use App\Livewire\BaseComponent;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuSub;

new class extends BaseComponent {
    public string $title;
    public string $description;
    public string $modelInstance = MenuSub::class;
    public Menu $menu;
    public $model;

    public function mount(MenuSub $model) {
        $this->canDo('update.' . $this->modelInstance);

        // Title and description
        $this->title = 'Update Sub Menu for ' . $this->menu->name;
        $this->description = 'Update existing sub menu data with the form below.';

        $this->model = $model;
        // Set properties from the old data
        $this->menu_id = $this->model->menu_id;
        $this->role_id = $this->model->role_id;
        $this->name = $this->model->name;
        $this->url = $this->model->url;
        $this->icon = $this->model->icon;
        $this->order = $this->model->order;
        $this->active_pattern = $this->model->active_pattern;
        $this->status = $this->model->status->value;
    }

    // Define roles for the menu update
    public $roles = [];

    // Properties for menu update
    public string $menu_id;
    public string $role_id;
    public string $name;
    public string $url;
    public ?string $icon;
    public int $order = 1;
    public ?string $active_pattern;
    public int $status = 1;

    public function save() {
        $this->validate([
            'menu_id' => 'required|exists:menus,id',
            'role_id' => 'required|exists:roles,id',
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'active_pattern' => 'nullable|string|max:255',
            'status' => 'required|in:' . implode(',', CommonStatusEnum::toArray()),
        ]);

        // Update the existing menu with the validated name
        $this->model->update($this->all());

        // Redirect to the menu index page after update
        to_route('cms.management.menu.sub', [
            'menu' => $this->menu->id,
        ])->with('success', 'Sub menu updated successfully.');
    }
}; ?>

<div>
    <x-acc-back url="{{ route('cms.management.menu.sub', [
        'menu' => $menu->id,
    ])  }}" />
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
                                <label class="form-label fw-bold">
                                    Main Menu
                                </label>
                                <x-acc-input :livewire="false" class="form-control" old="{{ $menu->name }}" :filled="true" disabled model="" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-acc-input model="name" label="Name" :filled="$name" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-acc-input model="url" label="URL" :filled="$url" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-acc-input model="icon" label="Icon" :filled="$icon" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-acc-input type="number" model="order" label="Order" :filled="$order" />
                            </div>
                            <div class="col-md-6 mb-3">
                                <x-acc-input model="active_pattern" label="Active Pattern" :filled="$active_pattern" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">
                                    Status
                                </label>
                                <x-acc-input type="select" model="status">
                                    <option value="">-- Select Status --</option>
                                    @foreach (CommonStatusEnum::cases() as $status)
                                        <option value="{{ $status->value }}">{{ $status->label() }}</option>
                                    @endforeach
                                </x-acc-input>
                            </div>
                        </div>
                        <div class="float-start">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-save me-2"></i>
                                Save
                            </button>
                            <a href="{{ route('cms.management.menu') }}" class="btn bg-gradient-dark btn-sm me-2">
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
