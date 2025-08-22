<?php

use App\Livewire\BaseComponent;
use App\Models\Spatie\Role;
use Livewire\Attributes\On;

new class extends BaseComponent {
    public string $title = 'Role Management';
    public string $description = 'Manage roles for your application.';
    public string $model = Role::class;

    // Pagination and Search
    public array $searchBy = [
        [
            'name' => 'Name',
            'field' => 'name',
        ],
        [
            'name' => 'Created At',
            'field' => 'created_at',
        ],
    ];
    public string $search = '';
    public int $paginate = 10;
    public string $orderBy = 'created_at';
    public string $order = 'desc';

    // Check permissions
    public function mount() {
        $this->canDo('view.' . $this->model);
    }

    public function with() {
        if ($this->search != null) {
            $this->resetPage();
        }

        return [
            'data' => $this->getDataWithFilter(
                model: new $this->model,
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
        $this->canDo('delete.' . $this->model, false);

        Role::findOrFail($id)->delete();

        $this->dispatch('alert', type: 'success', message: 'Role deleted successfully.');
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
                                <x-cms.action.create-btn :$model :link="route('cms.management.role.create')">
                                    +&nbsp; New Product
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
                                            {{ $d->created_at->format('d F Y') }}
                                        </td>
                                        <td class="align-middle">
                                            <x-cms.action.update-btn :$model :link="route('cms.management.role.edit', [
                                                'id' => $d->id,
                                            ])">
                                                <i class="fas fa-edit me-2"></i>
                                                Edit
                                            </x-cms.action.update-btn>
                                            <x-cms.action.delete-btn :$model :id="$d->id">
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
</div>
