<?php

namespace App\Livewire;

use App\Traits\Livewire\WithChangeOrder;
use App\Traits\WithGetFilterData;
use Flux\Flux;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

abstract class BaseComponent extends Component
{
    use WithChangeOrder, WithGetFilterData, WithPagination;

    public $paginationOrderBy = 'id';

    public $paginationOrder = 'desc';

    public $paginate = 10;

    public $isUpdate = false;

    public $search = '';

    public function create(bool $checkPermission = true, ?string $permission = null)
    {
        // Custom permission
        $permission = $permission ?? 'create'.$this->modelInstance;

        // Check permission
        if ($checkPermission) {
            Gate::authorize($permission);
        }

        // Set isUpdate to false
        $this->isUpdate = false;

        // Reset all properties
        $this->resetRecordData();
    }

    public function update($id, bool $checkPermission = true, ?string $permission = null)
    {
        // Custom permission
        $permission = $permission ?? 'update'.$this->modelInstance;

        if ($checkPermission) {
            Gate::authorize($permission);
        }

        // Set isUpdate to true
        $this->isUpdate = true;

        // Get record data
        $this->getRecordData($id);
    }

    #[On('delete')]
    public function delete($id)
    {
        Gate::authorize('delete'.$this->modelInstance);

        // Find record
        $modelClass = new $this->modelInstance;

        // Delete record
        try {
            $record = $modelClass->find($id);
            $record->delete();

            $this->dispatch('toast', type: 'success', message: 'Record deleted successfully.');
        } catch (\Exception $e) {
            $this->dispatch('toast', type: 'error', message: 'An error occurred while deleting the record.');
        }
    }

    protected function save(
        string $modal = 'defaultModal',
        bool $checkPermission = true,
        ?string $permission = null,
        $id = null,
    ) {
        // Determine action
        $action = $this->isUpdate ? 'update' : 'create';

        // Get id
        $id = $id ?? ($this->isUpdate ? $this->recordId : null);

        // Custom permission
        $permission = $permission ?? $action.$this->modelInstance;

        if ($checkPermission) {
            Gate::authorize($permission);
        }

        // Find or create record
        $modelClass = new $this->modelInstance;
        $record = $this->isUpdate ? $modelClass->find($id) : $modelClass;
        // Fill record with validated data
        $record->fill($this->all());

        // Save record
        try {
            $record->save();
            $this->dispatch('toast', type: 'success', message: 'Record saved successfully.');
            // Close modal
            Flux::modal($modal)->close();
        } catch (\Exception $e) {
            $this->dispatch('toast', type: 'error', message: 'An error occurred while saving the record.');
        }

        return $record;
    }

    protected function openModal(string $modal = 'defaultModal')
    {
        Flux::modal($modal)->show();
    }

    protected function closeModal(string $modal = 'defaultModal')
    {
        Flux::modal($modal)->close();
    }
}
