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
                @endphp
                @if($menu->type != 'header')
                    @if(auth()->user()->can('view.'.$menu->route) || $menu->route == '#')
                        <li class="sidebar-{{ $menu->type }} {{ $isActive ? 'active' : '' }}">
                            <a class="sidebar-link @if(count($menu->menuChildren) > 0) {{ $isActive ? '' : 'collapsed' }} @endif"
                                @if(count($menu->menuChildren) > 0)
                                    data-bs-target="#menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                    data-bs-toggle="collapse"
                                    aria-expanded="{{ $isActive ? 'true' : 'false' }}"
                                @endif
                                @if(count($menu->menuChildren) == 0)
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
                            @if(count($menu->menuChildren) > 0 && $menu->type != 'header')
                                <ul id="menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                    data-bs-parent class="sidebar-dropdown list-unstyled collapse {{ $isActive ? 'show' : '' }}"
                                    data-bs-parent="#sidebar">

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
                @else
                    <li class="sidebar-header">{{ $menu->name }}</li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
