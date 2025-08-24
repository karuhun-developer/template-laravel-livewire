<?php

use function Laravel\Folio\name;

name('cms.management.menu');

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
                'url' => '#',
                'active' => true,
            ],
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.menu.page />
</x-layouts.cms>
