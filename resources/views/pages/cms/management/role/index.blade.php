<?php

use function Laravel\Folio\name;

name('cms.management.role');

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
                'url' => '#',
                'active' => true,
            ],
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.role.page />
</x-layouts.cms>
