<?php

use function Laravel\Folio\name;

name('cms.management.menu.edit');

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
                'label' => 'Edit',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.menu.edit :$model />
</x-layouts.cms>
