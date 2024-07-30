<?php

namespace App\Livewire\Cms\Management;

use App\Livewire\Forms\Cms\Management\FormRole;
use App\Models\Role as RoleModel;
use BaseComponent;

class Role extends BaseComponent
{
    public FormRole $form;
    public $title = 'Management Role';

    public $searchBy = [
            [
                'name' => 'Name',
                'field' => 'name',
            ],
        ],
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'name',
        $order = 'asc';

    public function render()
    {
        $get = $this->getDataWithFilter(
            model: new RoleModel,
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.management.role', compact('get'))->title($this->title);
    }
}
