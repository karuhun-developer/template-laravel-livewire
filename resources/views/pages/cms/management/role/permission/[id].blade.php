<?php

use function Laravel\Folio\name;

name('cms.management.role.permission');

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
                'label' => 'Permissions',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.role.permission :$id />
</x-layouts.cms>
