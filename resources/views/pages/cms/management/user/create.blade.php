<?php

use function Laravel\Folio\name;

name('cms.management.user.create');

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
                'label' => 'User',
                'url' => route('cms.management.user'),
                'active' => false,
            ],
            [
                'label' => 'Create',
                'url' => '#',
                'active' => true,
            ]
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.user.create />
</x-layouts.cms>
