<?php

declare(strict_types=1);

use App\Actions\Cms\Management\Role\StoreRoleAction;
use App\Actions\Cms\Management\Role\UpdateRoleAction;
use App\DTOs\Cms\Management\Role\StoreRoleData;
use App\DTOs\Cms\Management\Role\UpdateRoleData;
use App\Models\Spatie\Role;
use Flux\Flux;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    /** @var class-string<Role> */
    #[Locked]
    public string $modelInstance = Role::class;

    public bool $isUpdate = false;

    // Record data
    public int $id;

    public string $name;

    public string $guard_name;

    #[On('set-action')]
    public function setAction(?int $id = null): void
    {
        $this->resetValidation();

        if ($id) {
            $this->isUpdate = true;
            $this->getRecordData($id);
        } else {
            $this->isUpdate = false;
            $this->resetRecordData();
        }
    }

    // Get record data
    public function getRecordData(int $id): void
    {
        Gate::authorize('show'.$this->modelInstance);

        $record = Role::find($id);
        $this->fill(
            $record->only(
                'id',
                'name',
                'guard_name',
            )
        );
    }

    // Reset record data
    public function resetRecordData(): void
    {
        $this->reset([
            'id',
            'name',
            'guard_name',
        ]);

        $this->guard_name = 'api';
    }

    // Handle form submit
    public function submit(StoreRoleAction $storeAction, UpdateRoleAction $updateAction): void
    {
        Gate::authorize(($this->isUpdate ? 'update' : 'create').$this->modelInstance);

        $this->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
        ]);

        if ($this->isUpdate) {
            $updateAction->handle(
                role: Role::findOrFail($this->id),
                data: UpdateRoleData::fromArray($this->all()),
            );
        } else {
            $storeAction->handle(
                data: StoreRoleData::fromArray($this->all()),
            );
        }

        // Toast message
        $this->dispatch('toast',
            type: 'success',
            message: $this->isUpdate ? 'Role updated successfully.' : 'Role created successfully.'
        );

        // Reset data table
        $this->dispatch('reset-parent-page');

        // Close modal
        Flux::modal('defaultModal')->close();
    }
};
