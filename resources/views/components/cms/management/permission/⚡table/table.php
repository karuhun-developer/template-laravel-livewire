<?php

use App\Actions\Cms\Management\Permission\DeletePermissionAction;
use App\Livewire\BaseComponent;
use App\Models\Spatie\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;

new class extends BaseComponent
{
    /** @var class-string<Permission> */
    public string $modelInstance = Permission::class;

    /**
     * Pagination and Search.
     *
     * @var array<int, array{name: string, field: string}>
     */
    public array $searchBy = [
        [
            'name' => 'Name',
            'field' => 'name',
        ],
        [
            'name' => 'Guard Name',
            'field' => 'guard_name',
        ],
    ];

    public function mount(): void
    {
        Gate::authorize('view'.$this->modelInstance);

        // Set default order by
        $this->paginationOrderBy = 'guard_name';
    }

    public function render(): View
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        // Query data with filters
        $data = $this->getDataWithFilter(
            model: new Permission,
            searchBy: $this->searchBy,
            orderBy: $this->paginationOrderBy,
            order: $this->paginationOrder,
            paginate: $this->paginate,
            s: $this->search,
        );

        return $this->view([
            'data' => $data,
        ]);
    }

    #[On('delete')]
    public function delete(int $id, DeletePermissionAction $deleteAction): void
    {
        Gate::authorize('delete'.$this->modelInstance);

        $deleteAction->handle(
            permission: Permission::findOrFail($id),
        );

        // Toast message
        $this->dispatch('toast',
            type: 'success',
            message: 'Permission deleted successfully',
        );
    }
};
