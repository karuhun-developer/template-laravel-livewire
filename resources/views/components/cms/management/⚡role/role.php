<?php

use App\Livewire\BaseComponent;
use App\Models\Spatie\Role;
use Illuminate\Support\Facades\Gate;

new class extends BaseComponent
{
    // Model instance
    public $modelInstance = Role::class;

    // Pagination and Search
    public $searchBy = [
        [
            'name' => 'Name',
            'field' => 'name',
        ],
        [
            'name' => 'Guard Name',
            'field' => 'guard_name',
        ],
    ];

    public function mount()
    {
        Gate::authorize('view'.$this->modelInstance);

        // Set default order by
        $this->paginationOrderBy = 'guard_name';
    }

    public function render()
    {
        if ($this->search != '') {
            $this->resetPage();
        }

        // Query data with filters
        $data = $this->getDataWithFilter(
            model: new Role,
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

    // Record data
    public $recordId;

    public $role_id;

    public $name;

    public $guard_name;

    // Get record data
    public function getRecordData($id)
    {
        Gate::authorize('show'.$this->modelInstance);

        $record = Role::find($id);
        $this->recordId = $record->id;
        $this->name = $record->name;
        $this->guard_name = $record->guard_name;
    }

    // Reset record data
    public function resetRecordData()
    {
        $this->reset([
            'recordId',
            'name',
            'guard_name',
        ]);

        $this->guard_name = 'api';
    }

    // Handle form submit
    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
        ]);

        $this->save();
    }
};
