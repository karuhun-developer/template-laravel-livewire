<?php

namespace App\Livewire\Cms\Management;

use App\Livewire\Forms\Cms\Management\FormMenu;
use Livewire\Attributes\Url;
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
        $search = '',
        $isUpdate = false,
        $paginate = 10,
        $orderBy = 'ordering',
        $order = 'asc';

    public function render()
    {
        $model = MenuModel::where('on', $this->on);

        $get = $this->getDataWithFilter(
            model: $model,
            searchBy: $this->searchBy,
            orderBy: $this->orderBy,
            order: $this->order,
            paginate: $this->paginate,
            s: $this->search
        );

        if ($this->search != null) {
            $this->resetPage();
        }

        return view('livewire.cms.management.menu', compact('get'))->title($this->title);
    }
}
