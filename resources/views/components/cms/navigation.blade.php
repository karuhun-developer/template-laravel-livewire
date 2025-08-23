@php
    function menuActive($activeRoute = []) {
        // Check if route name contains the active route
        foreach ($activeRoute as $route) {
            if(str_contains(request()->route()->getName(), $route) || request()->routeIs($route)) {
                return 'active bg-gradient-dark text-white';
                break;
            }
        }

        return 'text-dark';
    }

    // Show dropdown menu if the route is active
    function showDropdown($activeRoute = []) {
        foreach ($activeRoute as $route) {
            if(str_contains(request()->route()->getName(), $route) || request()->routeIs($route)) {
                return 'show';
                break;
            }
        }

        return '';
    }

    // Superadmin Menu
    $superAdminMenu = [
        [
            'label' => 'Dashboard',
            'icon' => 'fa fa-map',
            'url' => route('cms.dashboard'),
            'active' => ['cms.dashboard'],
        ],
        [
            'label' => 'Managements',
            'icon' => 'fa fa-cogs',
            'url' => '#',
            'active' => ['cms.management'],
            'children' => [
                [
                    'label' => 'Permission',
                    'icon' => null,
                    'url' => route('cms.management.permission'),
                    'active' => ['cms.management.permission'],
                ],
                [
                    'label' => 'Role',
                    'icon' => null,
                    'url' => route('cms.management.role'),
                    'active' => ['cms.management.role'],
                ],
                [
                    'label' => 'User',
                    'icon' => null,
                    'url' => route('cms.management.user'),
                    'active' => ['cms.management.user'],
                ]
            ],
        ],
    ];

    // Check user roles
    $listMenus = [];

    // Superadmin menu
    if (auth()->user()->hasRole('superadmin')) {
        $listMenus = $superAdminMenu;
    }
@endphp
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="#">
            <img src="{{ asset('cassets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26"
                alt="main_logo" />
            <span class="ms-1 text-sm text-dark">
                App Name
            </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @foreach ($listMenus as $key => $menu)
                <li class="nav-item">
                    <a
                        class="nav-link {{ menuActive($menu['active']) }}"
                        @if(isset($menu['children']))
                            data-bs-toggle="collapse"
                            href="#pages{{ $key }}"
                            class="nav-link text-dark"
                            role="button"
                            aria-expanded="true"
                        @else
                            href="{{ $menu['url'] }}"
                        @endif
                        >
                        <i class="{{ $menu['icon'] }} opacity-5 me-2"></i>
                        <span class="nav-link-text ms-1">
                            {{ $menu['label'] }}
                        </span>
                    </a>
                    <!-- Children menu -->
                    @if(isset($menu['children']))
                        <div class="collapse {{ showDropdown($menu['active']) }}" id="pages{{ $key }}">
                            <ul class="nav">
                                @foreach ($menu['children'] as $child)
                                    <li class="nav-item">
                                        <a class="nav-link {{ menuActive($child['active']) }}"
                                            href="{{ $child['url'] }}">
                                            @if($child['icon'])
                                                <i class="{{ $child['icon'] }} text-dark opacity-10 me-2"></i>
                                            @endif
                                            <span class="sidenav-normal ms-1 ps-1">
                                                {{ $child['label'] }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        @role('superadmin')
            <div class="mx-3">
                <a class="btn btn-outline-dark mt-4 w-100" href="{{ url('pulse') }}" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>
                    Laravel Pulse
                </a>
                <a class="btn bg-gradient-dark w-100" href="{{ url('logs') }}" target="_blank">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Laravel Log
                </a>
            </div>
        @endrole
    </div>
</aside>
