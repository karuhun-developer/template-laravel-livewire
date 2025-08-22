<?php

use function Laravel\Folio\name;

name('cms.management.permission');

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
                'url' => '#',
                'active' => true,
            ],
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.permission.page />
</x-layouts.cms>
