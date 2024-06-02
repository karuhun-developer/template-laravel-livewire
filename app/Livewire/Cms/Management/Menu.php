<?php

namespace App\Livewire\Cms\Management;

use Livewire\Attributes\Url;
use App\Livewire\Forms\Cms\Management\FormMenu;
use App\Models\Menu as MenuModel;
use BaseComponent;

class Menu extends BaseComponent
{
    public FormMenu $form;
    public $title = 'Management Menu';

    #[Url(keep: true)]
    public $on = 'cms';

    public $searchBy = [
            [
                'name' => 'Name',
                'field' => 'name',
            ],
            [
                'name' => 'On',
                'field' => 'on',
            ],
            [
                'name' => 'Type',
                'field' => 'type',
            ],
            [
                'name' => 'Icon',
                'field' => 'icon',
            ],
            [
                'name' => 'Route',
                'field' => 'route',
            ],
            [
                'name' => 'Ordering',
                'field' => 'ordering',
            ],
        ],
        $isUpdate = false,
        $search = '',
        $paginate = 10,
        $orderBy = 'ordering',
        $order = 'asc';

    public function mount() {
        $this->form->meta = [
            'description' => '',
            'keywords' => '',
        ];
    }

    public function customCreate() {
        $this->create();

        $this->form->meta = [
            'description' => '',
            'keywords' => '',
        ];
    }

    public function customEdit($id) {
        $this->edit($id);

        if($this->form->meta == null) {
            $this->form->meta = [
                'description' => '',
                'keywords' => '',
            ];
        }
    }

    public function render()
    {
        $model = MenuModel::where('on', $this->on);

        $get = $this->getDataWithFilter($model, [
            'orderBy' => $this->orderBy,
            'order' => $this->order,
            'paginate' => $this->paginate,
            's' => $this->search,
        ], $this->searchBy);

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.management.menu', compact('get'))->title($this->title);
    }
}
