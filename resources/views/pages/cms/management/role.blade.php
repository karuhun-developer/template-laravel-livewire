<?php

use function Laravel\Folio\name;

name('cms.management.role');

// Page title and breadcrumbs
$title = 'Management Role';
$description = 'Manage the application\'s management role items here.';
$breadcrumbs = [
    [
        'label' => 'Management',
        'url' => '#'
    ],
    [
        'label' => 'Role',
        'url' => null
    ],
];

?>

<x-layouts.app :$title>
    <div class="w-full">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-3xl font-bold">{{ $title }}</h1>
            <flux:breadcrumbs>
                <flux:breadcrumbs.item href="{{ route('cms.dashboard') }}" icon="home" />
                @foreach($breadcrumbs as $breadcrumb)
                    @if($breadcrumb['url'])
                        <flux:breadcrumbs.item href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</flux:breadcrumbs.item>
                    @else
                        <flux:breadcrumbs.item>{{ $breadcrumb['label'] }}</flux:breadcrumbs.item>
                    @endif
                @endforeach
            </flux:breadcrumbs>
        </div>
        <div class="border-gray-200 mb-6">
            <flux:text>
                {{ $description }}
            </flux:text>
        </div>
        <livewire:cms.management.role />
    </div>
</x-layouts.app>
