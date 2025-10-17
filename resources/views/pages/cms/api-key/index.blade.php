<?php

use function Laravel\Folio\name;

name('cms.api-key.index');

?>
<x-layouts.cms>
    <x-slot:breadcrumb>
        <x-cms.breadcrumb :items="[
            [
                'label' => 'API Keys',
                'url' => '#',
                'active' => false,
            ],
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.api-key.page />
</x-layouts.cms>
