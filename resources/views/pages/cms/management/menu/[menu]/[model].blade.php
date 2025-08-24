<?php

use App\Models\Menu\Menu;

use function Laravel\Folio\name;
use Illuminate\View\View;
use function Laravel\Folio\render;

name('cms.management.menu.sub.edit');

render(function (View $view, $menu, $model) {
    $menu = Menu::find($menu);
    // If menu not found, redirect to menu index with error message
    if (!$menu) return to_route('cms.management.menu')->with('error', 'Menu not found');

    return $view->with(compact('menu', 'model'));
});

?>
<x-layouts.cms>
    <x-slot:breadcrumb>
        <x-cms.breadcrumb :items="[
            [
                'label' => 'Managements',
                'url' => '#',
                'active' => false,
            ],
            [
                'label' => $menu->name,
                'url' => route('cms.management.menu'),
                'active' => true,
            ],
            [
                'label' => 'Sub Menu',
                'url' => route('cms.management.menu.sub', [
                    'menu' => $menu->id,
                ]),
                'active' => true,
            ],
            [
                'label' => 'Edit',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.menu.sub.edit :$menu :$model  />
</x-layouts.cms>
