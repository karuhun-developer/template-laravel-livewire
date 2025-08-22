<?php

use function Laravel\Folio\name;

name('cms.management.permission.edit');

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
                'label' => 'Edit',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.permission.edit :$id />
</x-layouts.cms>
