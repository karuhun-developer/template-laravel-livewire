<?php

use function Laravel\Folio\name;

name('cms.dashboard');

?>
<x-layouts.cms>
    <x-slot:breadcrumb>
        <x-cms.breadcrumb :items="[
            [
                'label' => 'Dashboard',
                'url' => '#',
                'active' => false,
            ],
        ]" />
    </x-slot:breadcrumb>
</x-layouts.cms>
