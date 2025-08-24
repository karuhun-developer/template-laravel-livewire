<?php

use App\Models\Menu\Menu;

use function Laravel\Folio\name;
use Illuminate\View\View;
use function Laravel\Folio\render;

name('cms.management.menu.sub');

render(function (View $view, $menu) {
    $menu = Menu::find($menu);
    // If menu not found, redirect to menu index with error message
    if (!$menu) return to_route('cms.management.menu')->with('error', 'Menu not found');

    return $view->with(compact('menu'));
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
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.menu.sub.page :$menu />
</x-layouts.cms>
