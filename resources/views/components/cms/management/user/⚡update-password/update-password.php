<?php

declare(strict_types=1);

use App\Actions\Cms\Management\User\UpdateUserPasswordAction;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Gate;
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

    public ?string $password = null;

    #[On('set-update-password')]
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

    // Get record data
    public function getRecordData(int $id): void
    {
        Gate::authorize('show'.$this->modelInstance);

        $record = User::find($id);
        $this->id = $record->id;
        $this->reset('password');
    }

    // Handle change password submit
    public function submit(UpdateUserPasswordAction $updatePasswordAction): void
    {
        // Validation rules
        $this->validate([
            'password' => 'required|string|min:8',
        ]);

        // Find user and update password
        $updatePasswordAction->handle(
            user: User::findOrFail($this->id),
            password: $this->password,
        );

        // Toast message
        $this->dispatch('toast', type: 'success', message: 'Password changed successfully.');

        // Close modal
        Flux::modal('changePasswordModal')->close();
    }
};
