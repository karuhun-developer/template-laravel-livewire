<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
    <div class="container-fluid">
        <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('cms.dashboard') }}" wire:navigate>
                @if($settings->getFirstMediaUrl('logo') != '')
                    <img src="{{ $settings->getFirstMediaUrl('logo') }}" class="navbar-brand-image" alt="{{ $settings->name }}" />
                @else
                    <img src="{{ asset('img/logo.svg') }}" class="navbar-brand-image" alt="{{ $settings->name }}" />
                @endif
            </a>
        </div>
        <div class="navbar-nav flex-row d-lg-none"></div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                @foreach ($menus as $menu)
                    @php
                        $isActive = false;

                        // Check if menu is active
                        $isActive =
                            request()->routeIs($menu->route) || str_contains(request()->path(), strtolower($menu->name));
                        // Check if has child
                        $hasChild = count($menu->menuChildren) > 0;
                        // Check if child permission > 0
                        $childPermissionOk = false;
                        foreach ($menu->menuChildren as $children) {
                            if (
                                auth()
                                    ->user()
                                    ->can('view.' . $children->route)
                            ) {
                                $childPermissionOk = true;
                                break;
                            }
                        }
                    @endphp
                    @if ($menu->type != 'header')
                        @if (auth()->user()->can('view.' . $menu->route) || $menu->route == '#')
                            {{-- Hide management to other user except admin --}}
                            @if ($childPermissionOk || $menu->route != '#')
                                <li class="nav-item
                                    {{ $isActive ? 'active' : '' }}
                                        @if($hasChild)
                                            dropdown
                                        @endif
                                    ">
                                    <a class="
                                        nav-link
                                            @if ($hasChild)
                                                dropdown-toggle
                                                {{ $isActive ? '' : 'collapsed' }} @endif"
                                            @if ($hasChild)
                                                data-bs-toggle="collapse"
                                                data-bs-auto-close="false"
                                                href="#menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                                aria-expanded="{{ $isActive ? 'true' : 'false' }}"
                                                role="button"
                                            @else
                                                href="{{ \Illuminate\Support\Facades\Route::has($menu->route) ? route($menu->route) : '#' }}"
                                                wire:navigate
                                            @endif>
                                        <span>
                                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                                <i class="{{ $menu->icon }}"></i>
                                            </span>
                                            <span class="nav-link-title">
                                                {{ $menu->name }}
                                            </span>
                                        </span>
                                    </a>

                                    {{-- Check if has child --}}
                                    @if ($hasChild && $menu->type != 'header')
                                        <div id="menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                            class="dropdown-menu collapse {{ $isActive ? 'show' : '' }}">
                                            <div class="dropdown-menu-columns">
                                                <div class="dropdown-menu-column">
                                                    {{-- Loop child --}}
                                                    @foreach ($menu->menuChildren as $children)
                                                        @can('view.' . $children->route)
                                                            @php
                                                                $childIsActive =
                                                                    request()->routeIs($children->route)
                                                                    // ||
                                                                    // str_contains(
                                                                    //     request()->path(),
                                                                    //     strtolower($children->name),
                                                                    // );
                                                            @endphp
                                                            <a class="dropdown-item {{ $childIsActive ? 'active' : '' }}"
                                                                href="{{ \Illuminate\Support\Facades\Route::has($children->route) ? route($children->route) : '#' }}"
                                                                wire:navigate>
                                                                    {{ $children->name }}
                                                                    @if ($children->icon != '#')
                                                                        <span class="badge badge-sm bg-green-lt text-uppercase ms-auto">
                                                                            <i class="{{ $children->icon }}"></i>
                                                                        </span>
                                                                    @endif
                                                                </a>
                                                            </a>
                                                        @endcan
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </li>
                            @endif
                        @endif
                    @else
                    @endif
                @endforeach

                @role('admin')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pulse') }}" target="_blank">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fas fa-external-link-alt"></i>
                            </span>
                            <span class="nav-link-title">
                                Laravel Pulse
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cms.logs') }}" target="_blank">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="fas fa-clipboard-list"></i>
                            </span>
                            <span class="nav-link-title">
                                Laravel Log
                            </span>
                        </a>
                    </li>
                @endrole
            </ul>
        </div>
    </div>
</aside>
