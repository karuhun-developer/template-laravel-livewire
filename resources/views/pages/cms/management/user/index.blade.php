<?php

use function Laravel\Folio\name;

name('cms.management.user');

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
                'url' => '#',
                'active' => true,
            ],
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.user.page />
</x-layouts.cms>
