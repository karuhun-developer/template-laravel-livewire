<?php

use function Laravel\Folio\name;

name('cms.management.permission.create');

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
                'label' => 'Permission',
                'url' => route('cms.management.permission'),
                'active' => false,
            ],
            [
                'label' => 'Create',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.permission.create />
</x-layouts.cms>
