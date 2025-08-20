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
                'url' => route('cms.managements.roles'),
                'active' => true,
            ],
        ]" />
    </x-slot:breadcrumb>
    <livewire:cms.management.role.page />
</x-layouts.cms>
