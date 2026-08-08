<?php

declare(strict_types=1);

use App\Actions\Cms\Management\MenuSub\DeleteMenuSubAction;
use App\Livewire\BaseComponent;
use App\Models\Menu\Menu;
use App\Models\Menu\MenuSub;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;

new class extends BaseComponent
{
    /** @var class-string<MenuSub> */
    #[Locked]
    public string $modelInstance = MenuSub::class;

    public Menu $menu;

    /**
     * Pagination and Search.
     *
     * @var array<int, array{name: string, field: string}>
     */
    public array $searchBy = [
        [
            'name' => 'Role',
            'field' => 'roles.name',
        ],
        [
            'name' => 'Menu',
            'field' => 'menu_subs.name',
        ],
        [
            'name' => 'URL',
            'field' => 'menu_subs.url',
        ],
        [
            'name' => 'Icon',
            'field' => 'menu_subs.icon',
        ],
        [
            'name' => 'Order',
            'field' => 'menu_subs.order',
        ],
        [
            'name' => 'Active Pattern',
            'field' => 'menu_subs.active_pattern',
        ],
        [
            'name' => 'Status',
            'field' => 'menu_subs.status',
        ],
    ];

    public function mount(): void
    {
        Gate::authorize('view'.$this->modelInstance);

        // Set default order by
        $this->paginationOrderBy = 'menu_subs.order';
    }

    public function render(): View
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        // Query data with filters
        $model = MenuSub::query()
            ->join('roles', 'menu_subs.role_id', '=', 'roles.id')
            ->where('menu_subs.menu_id', $this->menu->id)
            ->select(
                'menu_subs.*',
                'roles.name as role_name',
            );

        $data = $this->getDataWithFilter(
            model: $model,
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
    public function delete(int $id, DeleteMenuSubAction $deleteAction): void
    {
        Gate::authorize('delete'.$this->modelInstance);

        $deleteAction->handle(
            menuSub: MenuSub::findOrFail($id),
        );

        // Flush cache
        Cache::flush();

        // Toast message
        $this->dispatch('toast',
            type: 'success',
            message: 'Menu Sub deleted successfully',
        );
    }
};
