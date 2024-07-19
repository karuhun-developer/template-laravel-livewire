<?php

namespace App\Livewire\Cms\Management\Menu\Child;

use App\Livewire\Forms\Cms\Management\FormMenuChild;
use App\Models\MenuChild;
use App\Models\Menu;
use BaseComponent;
use Override;

class Index extends BaseComponent
{
    public FormMenuChild $form;
    public $title;

    public $searchBy = [
            [
                'name' => 'Name',
                'field' => 'name',
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
        $paginate = 10,
        $orderBy = 'ordering',
        $order = 'asc';

    public $menu;

    public function mount($menu = null) {
        $this->menu = Menu::find($menu);

        // Check menu exist
        if(!$this->menu) return $this->redirectRoute('cms.management.menu');

        $this->title = ucfirst($this->menu->name) . ' Menu Child';
    }

    public function render()
    {
        $model = MenuChild::where('menu_id', $this->menu->id);

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

        return view('livewire.cms.management.menu.child.index', compact('get'))->title($this->title);
    }

    #[Override]
    public function create($navigate = true) {
        $this->redirectRoute($this->originRoute . '.manage', [
            'menu' => $this->menu->id,
        ], navigate: $navigate);
    }

    #[Override]
    public function edit($id, $navigate = true) {
        $this->redirectRoute($this->originRoute . '.manage', [
            'menu' => $this->menu->id,
            'id' => $id,
        ], navigate: $navigate);
    }
}
