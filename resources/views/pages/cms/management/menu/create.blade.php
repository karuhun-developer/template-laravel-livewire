<?php

use function Laravel\Folio\name;

name('cms.management.menu.create');

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
                'label' => 'Menu',
                'url' => route('cms.management.menu'),
                'active' => false,
            ],
            [
                'label' => 'Create',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.menu.create />
</x-layouts.cms>
