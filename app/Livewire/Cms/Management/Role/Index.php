<?php

namespace App\Livewire\Cms\Management\Role;

use App\Livewire\Forms\Cms\Management\FormRole;
use App\Models\Role;
use BaseComponent;

class Index extends BaseComponent
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
        $paginate = 10,
        $orderBy = 'name',
        $order = 'asc';

    public function render()
    {
        $get = $this->getDataWithFilter(new Role, [
            'orderBy' => $this->orderBy,
            'order' => $this->order,
            'paginate' => $this->paginate,
            's' => $this->search,
        ], $this->searchBy);

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.management.role.index', compact('get'))->title($this->title);
    }
}
