<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('cms.dashboard') }}">
            <span class="align-middle">{{ $settings->name }}</span>
        </a>

        <ul class="sidebar-nav">
            @foreach($menus as $menu)
                @php
                    $isActive = false;

                    // Check if menu is active
                    $isActive = request()->routeIs($menu->route) || str_contains(request()->path(), strtolower($menu->name));
                    // Check if has child
                    $hasChild = count($menu->menuChildren) > 0;
                    // Check if child permission > 0
                    $childPermissionOk = false;
                    foreach ($menu->menuChildren as $children) {
                        if (auth()->user()->can('view.'.$children->route)) {
                            $childPermissionOk = true;
                            break;
                        }
                    }
                @endphp
                @if($menu->type != 'header')
                    @if(auth()->user()->can('view.'.$menu->route) || $menu->route == '#')
                        {{-- Hide management to other user except admin --}}
                        @if($childPermissionOk || $menu->route != '#')
                            <li class="sidebar-{{ $menu->type }} {{ $isActive ? 'active' : '' }}">
                                <a class="sidebar-link @if($hasChild) {{ $isActive ? '' : 'collapsed' }} @endif"
                                    @if($hasChild)
                                        data-bs-target="#menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                        data-bs-toggle="collapse"
                                        aria-expanded="{{ $isActive ? 'true' : 'false' }}"
                                    @else
                                        href="{{ \Illuminate\Support\Facades\Route::has($menu->route) ? route($menu->route) : '#' }}"
                                        wire:navigate
                                    @endif>

                                    {{-- Icon --}}
                                    @if($menu->type != 'header')
                                        <i class="{{ $menu->icon }}"></i>
                                    @endif
                                    <span class="align-middle">{{ $menu->name }}</span>
                                </a>

                                {{-- Check if has child --}}
                                @if($hasChild && $menu->type != 'header')
                                    <ul id="menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                        data-bs-parent class="sidebar-dropdown list-unstyled collapse {{ $isActive ? 'show' : '' }}"
                                        data-bs-parent="#sidebar"
                                        x-data="{ totalChild: 0 }">

                                        {{-- Loop child --}}
                                        @foreach ($menu->menuChildren as $children)
                                            @can('view.'.$children->route)
                                                @php
                                                    $childIsActive = request()->routeIs($children->route) || str_contains(request()->path(), strtolower($children->name));
                                                @endphp
                                                <li class="sidebar-item {{ $childIsActive ? 'active' : '' }}">
                                                    <a class="sidebar-link" href="{{
                                                        \Illuminate\Support\Facades\Route::has($children->route)
                                                        ? route($children->route)
                                                        : '#'
                                                    }}" wire:navigate>
                                                        @if($children->icon != '#')
                                                            <i class="{{ $children->icon }}"></i>
                                                        @endif
                                                        {{ $children->name }}
                                                    </a>
                                                </li>
                                            @endcan
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endif
                    @endif
                @else
                    <li class="sidebar-header">{{ $menu->name }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
