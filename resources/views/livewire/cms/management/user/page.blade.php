<?php

use App\Livewire\BaseComponent;
use App\Models\User;
use Livewire\Attributes\On;

new class extends BaseComponent {
    public string $title = 'User Management';
    public string $description = 'Manage users for your application.';
    public string $modelInstance = User::class;

    // Pagination and Search
    public array $searchBy = [
        [
            'name' => 'Name',
            'field' => 'users.name',
        ],
        [
            'name' => 'Email',
            'field' => 'users.email',
        ],
        [
            'name' => 'Role',
            'field' => 'roles.name',
        ],
        [
            'name' => 'Email Verified',
            'field' => 'users.email_verified_at',
        ],
        [
            'name' => 'Created At',
            'field' => 'users.created_at',
        ],
    ];
    public string $search = '';
    public int $paginate = 10;
    public string $orderBy = 'users.created_at';
    public string $order = 'desc';

    // Check users
    public function mount() {
        $this->canDo('view.' . $this->modelInstance);
    }

    public function with() {
        if ($this->search != null) {
            $this->resetPage();
        }

        $model = (new $this->modelInstance)->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->select('users.*', 'roles.name as role');

        return [
            'data' => $this->getDataWithFilter(
                model: $model,
                searchBy: $this->searchBy,
                orderBy: $this->orderBy,
                order: $this->order,
                paginate: $this->paginate,
                s: $this->search,
            ),
        ];
    }

    #[On('delete')]
    public function delete($id) {
        $this->canDo('delete.' . $this->modelInstance, false);

        User::findOrFail($id)->delete();

        $this->dispatch('alert', type: 'success', message: 'User deleted successfully.');
    }

    // Change Password
    public $oldData;
    public string $password = '';

    public function changePassword($id) {
        $this->oldData = User::find($id);
        $this->openModal();
    }

    public function savePassword() {
        $this->canDo('update.' . $this->modelInstance, false);

        $this->validate([
            'password' => 'required|min:8',
        ]);

        $this->oldData->update([
            'password' => bcrypt($this->password),
        ]);

        $this->password = '';

        $this->dispatch('alert', type: 'success', message: 'Password changed successfully.');
        $this->closeModal();
    }
}; ?>

<div>
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
                                <x-cms.action.create-btn :$modelInstance :link="route('cms.management.user.create')">
                                    +&nbsp; New User
                                </x-cms.action.create-btn>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header position-relative">
                    <div class="row mt-1">
                        <div class="col-md-6">
                            <x-acc-input type="select" model="paginate" :debounce="true" :debounceMs="100">
                                <option value="10">10 enteries per page</option>
                                <option value="25">25 enteries per page</option>
                                <option value="50">50 enteries per page</option>
                                <option value="100">100 enteries per page</option>
                            </x-acc-input>
                        </div>
                        <div class="col-md-6">
                            <x-acc-input type="text" model="search" label="Search...." :debounce="true" :debounceMs="100" />
                        </div>
                    </div>
                </div>
                <div class="card-body pb-4">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead>
                                <tr>
                                    <x-cms.livewire.loop-th :$searchBy :$orderBy :$order />
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->name }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->email }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->role }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {!!
                                                $d->email_verified_at ?
                                                '<span class="badge bg-success">Verified</span>' :
                                                '<span class="badge bg-danger">Not Verified</span>'
                                            !!}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->created_at->format('d F Y') }}
                                        </td>
                                        <td class="align-middle">
                                            <x-cms.action.button type="button" :permission="'update.' . $modelInstance" wire:click="changePassword('{{ $d->id }}')">
                                                <i class="fas fa-key me-2"></i>
                                                Change Password
                                            </x-cms.action.button>
                                            <x-cms.action.update-btn :$modelInstance :link="route('cms.management.user.edit', [
                                                'model' => $d->id,
                                            ])">
                                                <i class="fas fa-edit me-2"></i>
                                                Edit
                                            </x-cms.action.update-btn>
                                            <x-cms.action.delete-btn :$modelInstance :id="$d->id">
                                                <i class="fas fa-trash me-2"></i>
                                                Delete
                                            </x-cms.action.delete-btn>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100" class="text-center text-secondary">
                                            <h6 class="mb-0 text-sm">
                                                <i class="fas fa-exclamation-triangle me-2"></i>
                                                No data found.
                                            </h6>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Change Password -->
    <x-cms.livewire.modal title="Change Password">
        <form wire:submit.prevent="savePassword">
            <div class="row">
                <div class="col-md-12 mb-3">
                    <x-acc-input type="password" model="password" label="Password" />
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fas fa-save me-2"></i>
                Change Password
            </button>
        </form>
    </x-cms.livewire.modal>
</div>
