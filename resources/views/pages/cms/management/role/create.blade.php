<?php

use function Laravel\Folio\name;

name('cms.management.role.create');

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
                'label' => 'Role',
                'url' => route('cms.management.role'),
                'active' => false,
            ],
            [
                'label' => 'Create',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.role.create />
</x-layouts.cms>
