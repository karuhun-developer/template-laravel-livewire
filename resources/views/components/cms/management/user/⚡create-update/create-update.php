<?php

declare(strict_types=1);

use App\Actions\Cms\Management\User\StoreUserAction;
use App\Actions\Cms\Management\User\UpdateUserAction;
use App\DTOs\Cms\Management\User\StoreUserData;
use App\DTOs\Cms\Management\User\UpdateUserData;
use App\Models\Spatie\Role;
use App\Models\User;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component
{
    /** @var class-string<User> */
    #[Locked]
    public string $modelInstance = User::class;

    public bool $isUpdate = false;

    // Record data
    public ?int $id = null;

    public ?string $role = null;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $password = null;

    #[On('set-action')]
    public function setAction(?int $id = null): void
    {
        $this->resetValidation();

        if ($id) {
            $this->isUpdate = true;
            $this->getRecordData($id);
        } else {
            $this->isUpdate = false;
            $this->reset();
        }
    }

    /**
     * @return Collection<int, Role>
     */
    #[Computed]
    public function roles(): Collection
    {
        return Role::all();
    }

    // Get record data
    public function getRecordData(int $id): void
    {
        Gate::authorize('show'.$this->modelInstance);

        $record = User::find($id);
        $this->fill(
            $record->only(
                'id',
                'name',
                'email',
            )
        );
        $this->role = $record->getRoleNames()[0];
        $this->reset('password');
    }

    // Handle form submit
    public function submit(StoreUserAction $storeAction, UpdateUserAction $updateAction): void
    {
        Gate::authorize(($this->isUpdate ? 'update' : 'create').$this->modelInstance);

        $this->validate([
            'role' => 'required|string|exists:roles,name',
            'name' => 'required|string|max:255',
            'email' => $this->isUpdate ? 'required|string|email|max:255|unique:users,email,'.$this->id : 'required|string|email|max:255|unique:users,email',
            'password' => $this->isUpdate ? 'nullable' : 'required|string|min:8',
        ]);

        if ($this->isUpdate) {
            $updateAction->handle(
                user: User::findOrFail($this->id),
                data: UpdateUserData::fromArray($this->except('password')),
            );
        } else {
            $storeAction->handle(
                data: StoreUserData::fromArray($this->all()),
            );
        }

        // Toast message
        $this->dispatch('toast',
            type: 'success',
            message: $this->isUpdate ? 'User updated successfully.' : 'User created successfully.',
        );

        // Reset data table
        $this->dispatch('reset-parent-page');

        // Close modal
        Flux::modal('defaultModal')->close();
    }
};
