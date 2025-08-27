<?php

use App\Livewire\BaseComponent;
use App\Models\Spatie\Permission;
use App\Models\Spatie\Role;

new class extends BaseComponent {
    public string $title = 'Role Permission';
    public string $description = 'Manage permissions for a specific role.';
    public $permissions = [];
    public $role;

    public function mount(Role $model) {
        $this->canDo([
            'create.' . Role::class,
            'update.' . Role::class,
            'delete.' . Role::class,
        ]);

        $this->role = $model;

        // Get list of permissions
        $this->getPermissions();
    }

    protected function getPermissions() {
        $permission = Permission::all();

        // Get all permission that avaliable
        foreach ($permission as $perm) {
            $perm = explode('.', $perm->name);
            $this->permissions[$perm[1]][$perm[0]] = false;
        }

        // Check if role has permissions
        foreach ($this->role->permissions->pluck('name') as $permission) {
            $perm = explode('.', $permission);
            $this->permissions[$perm[1]][$perm[0]] = true;
        }
    }

    // Check all
    public function checkAll() {
        foreach($this->permissions as $key => $value) {
            foreach($value as $k => $v) {
                $this->check($k, $key);
                $this->permissions[$key][$k] = true;
            }
        }

        // Redirect to the role permission page
        to_route('cms.management.role.permission', [
            'id' => $this->role->id,
        ])->with('success', 'All permissions have been granted to the role.');
    }

    // Uncheck all
    public function uncheckAll() {
        foreach($this->permissions as $key => $value) {
            foreach($value as $k => $v) {
                $this->uncheck($k, $key);
                $this->permissions[$key][$k] = false;
            }
        }

        // Redirect to the role permission page
        to_route('cms.management.role.permission', [
            'id' => $this->role->id,
        ])->with('success', 'All permissions have been revoked from the role.');
    }

    // Check
    public function check($action, $model) {
        $permission = $action . '.' . $model;
        $this->isPermissionExist($permission);
        $this->role->givePermissionTo($permission);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->role)
            ->withProperties([
                'permission' => $permission,
            ])
            ->event('check-permission')
            ->log('Add permission');
    }

    // Uncheck
    public function uncheck($action, $model) {
        $permission = $action . '.' . $model;
        $this->isPermissionExist($permission);
        $this->role->revokePermissionTo($permission);

        activity()
            ->causedBy(auth()->user())
            ->performedOn($this->role)
            ->withProperties([
                'permission' => $permission,
            ])
            ->event('uncheck-permission')
            ->log('Remove permission');
    }

    // Is Permission Exist
    public function isPermissionExist($permission) {
        $isPermissionExist = Permission::where('name', $permission)->first();
        if(is_null($isPermissionExist)) return false;
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
                        <div class="ms-auto my-auto mt-lg-0">
                            <div class="ms-auto my-auto">
                                <button class="btn bg-gradient-dark btn-sm mb-0" wire:click="checkAll" wire:loading.attr="disabled">
                                    <i class="fa fa-check"></i>
                                    <span class="ms-2">
                                        Check All
                                    </span>
                                </button>
                                <button class="btn bg-gradient-danger btn-sm mb-0" wire:click="uncheckAll" wire:loading.attr="disabled">
                                    <i class="fa fa-x"></i>
                                    <span class="ms-2">
                                        Uncheck All
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-4">
                    <div class="row">
                        @foreach($permissions as $route => $type)
                            <div class="col-md-12 mb-2">
                                <hr>
                                <h5>Route: {{ $route }}</h5>
                                <div class="row">
                                @foreach($type as $name => $value)
                                    @php
                                        $label = explode('.', $name);
                                        $label = $label[0];
                                    @endphp
                                    <div class="col-md-3 mb-2">
                                        <div class="form-check form-switch" x-data="{ check: {{ $value ? 'true' : 'false' }} }" x-init="$watch('check', value => {
                                            $wire.{{ $value ? 'uncheck' : 'check' }}('{{ $name }}', '{{ str_replace('\\', '\\\\', $route) }}');
                                        });">
                                            <input class="form-check-input"
                                                type="checkbox"
                                                x-model="check"
                                                wire:loading.attr="disabled" />
                                            <label class="form-check-label">{{ ucfirst($label) }}</label>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
