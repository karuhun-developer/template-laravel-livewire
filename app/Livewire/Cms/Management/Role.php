<?php

namespace App\Livewire\Cms\Management;

use App\Livewire\Forms\Cms\Management\FormRole;
use Spatie\Permission\Models\Role as RoleModel;
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
        $isUpdate = false,
        $search = '',
        $paginate = 10,
        $orderBy = 'name',
        $order = 'asc';

    public function render()
    {
        $get = $this->getDataWithFilter(new RoleModel, [
            'orderBy' => $this->orderBy,
            'order' => $this->order,
            'paginate' => $this->paginate,
            's' => $this->search,
        ], $this->searchBy);

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.management.role', compact('get'))->title($this->title);
    }
}
