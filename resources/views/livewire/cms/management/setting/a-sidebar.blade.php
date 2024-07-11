<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Settings</h5>
    </div>
    <style>
        .custom-list-group-item {
            cursor: pointer;
            background-color: white;
            padding: 12px;
        }
    </style>
    @php
        $listSetting = [
            [
                'name' => 'General',
                'route' => 'cms.management.general-setting',
            ],
            [
                'name' => 'Misc Setting',
                'route' => 'cms.management.misc-setting',
            ],
            [
                'name' => 'Mail Setting',
                'route' => 'cms.management.mail-setting',
            ],
            [
                'name' => 'Privacy Policy',
                'route' => 'cms.management.privacy-policy-setting',
            ],
            [
                'name' => 'Term Of Service',
                'route' => 'cms.management.term-of-service-setting',
            ],
        ];
    @endphp
    <div class="list-group list-group-flush" role="tablist" wire:ignore>
        @foreach($listSetting as $setting)
            @php
                $routeActive = request()->routeIs($setting['route']) ? 'active' : '';
            @endphp
            <a
                class="custom-list-group-item list-group-item list-group-item-action {{ $routeActive }}"
                href="{{ route($setting['route']) }}"
                role="tab" wire:navigate>
                {{ ucfirst($setting['name']) }}
            </a>
        @endforeach
    </div>
</div>
