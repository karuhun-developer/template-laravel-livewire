<?php

use App\Livewire\BaseComponent;
use App\Models\Menu\Menu;
use App\Models\Spatie\Role;
use Livewire\Attributes\On;

new class extends BaseComponent {
    public string $title = 'Menu Management';
    public string $description = 'Manage menus for your application.';
    public string $modelInstance = Menu::class;

    // Pagination and Search
    public array $searchBy = [
        [
            'name' => 'Role',
            'field' => 'roles.name',
        ],
        [
            'name' => 'Menu',
            'field' => 'menus.name',
        ],
        [
            'name' => 'URL',
            'field' => 'menus.url',
        ],
        [
            'name' => 'Icon',
            'field' => 'menus.icon',
        ],
        [
            'name' => 'Order',
            'field' => 'menus.order',
        ],
        [
            'name' => 'Active Pattern',
            'field' => 'menus.active_pattern',
        ],
        [
            'name' => 'Status',
            'field' => 'menus.status',
        ],
    ];
    public string $search = '';
    public int $paginate = 10;
    public string $orderBy = 'order';
    public string $order = 'asc';
    public $whereRoleId;
    public $roles = [];

    // Check menus
    public function mount() {
        $this->canDo('view.' . $this->modelInstance);

        // Get roles
        $this->roles = Role::all();
    }

    public function with() {
        if ($this->search != null) {
            $this->resetPage();
        }

        $model = (new $this->modelInstance)->query()
            ->join('roles', 'roles.id', '=', 'menus.role_id')
            ->select(
                'menus.*',
                'roles.name as role_name'
            );

        if ($this->whereRoleId) {
            $model->where('menus.role_id', $this->whereRoleId);
        }

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

        Menu::findOrFail($id)->delete();

        $this->dispatch('alert', type: 'success', message: 'Menu deleted successfully.');
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
                                <x-cms.action.create-btn :$modelInstance :link="route('cms.management.menu.create')">
                                    +&nbsp; New Menu
                                </x-cms.action.create-btn>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-header position-relative">
                    <div class="row mt-1">
                        <div class="col-md-4">
                            <x-acc-input type="select" model="paginate" :debounce="true" :debounceMs="100">
                                <option value="10">10 enteries per page</option>
                                <option value="25">25 enteries per page</option>
                                <option value="50">50 enteries per page</option>
                                <option value="100">100 enteries per page</option>
                            </x-acc-input>
                        </div>
                        <div class="col-md-4">
                            <x-acc-input type="select" model="whereRoleId" :debounce="true" :debounceMs="100">
                                <option value="">-- Filter by Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </x-acc-input>
                        </div>
                        <div class="col-md-4">
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
                                            {{ $d->role_name }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->name }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->url }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <i class="{{ $d->icon }}"></i>
                                            {{ $d->icon }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->order }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            {{ $d->active_pattern }}
                                        </td>
                                        <td class="text-sm font-weight-normal">
                                            <span class="{{ $d->status->color() }}">
                                                {{ $d->status->label() }}
                                            </span>
                                        </td>
                                        <td class="align-middle">
                                            <x-cms.action.button permission="view.{{ \App\Models\Menu\MenuSub::class }}" href="{{ route('cms.management.menu.sub', [
                                                'menu' => $d->id,
                                            ]) }}">
                                                <i class="fas fa-eye me-2"></i>
                                                Sub Menu
                                            </x-cms.action.button>
                                            <x-cms.action.update-btn :$modelInstance :link="route('cms.management.menu.edit', [
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
</div>
