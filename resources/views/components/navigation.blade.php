<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img
                        src="{{ asset('admin/img/avatars/avatar.jpg') }}"
                        class="card-img-top rounded-circle border-white"
                        alt="{{ auth()->user()->name }}"
                    />
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">
                        {{ auth()->user()->name }}
                    </h2>
                    <a href="#" class="btn btn-secondary btn-sm d-inline-flex align-items-center"
                        x-on:click.prevent="
                            Swal.fire({
                                title: 'Are you sure?',
                                text: '',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch('{{ route('logout') }}', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                        }
                                    }).then(() => {
                                        window.location.href = '/login'
                                    })
                                }
                            })
                        ">
                        <span class="icon icon-xxs me-1">
                            <i class="fas fa-sign-out-alt"></i>
                        </span>
                        Sign Out
                    </a>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <span class="icon icon-xs">
                        <i class="fas fa-times"></i>
                    </span>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="{{ route('cms.dashboard') }}" wire:navigate class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img
                            src="{{ asset('admin/img/brand/light.svg') }}"
                            height="20"
                            width="20"
                            alt="{{ $settings->name }}"
                        />
                    </span>
                    <span class="mt-1 ms-1 sidebar-text">
                        {{ $settings->name }}
                    </span>
                </a>
            </li>
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
                            <li class="nav-item {{ $isActive ? 'active' : '' }}">
                                <a class="
                                    nav-link
                                    @if($hasChild)
                                        d-flex
                                        justify-content-between
                                        align-items-center
                                        {{ $isActive ? '' : 'collapsed' }}
                                    @endif"
                                    @if($hasChild)
                                        data-bs-target="#menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                        data-bs-toggle="collapse"
                                        aria-expanded="{{ $isActive ? 'true' : 'false' }}"
                                    @else
                                        href="{{ \Illuminate\Support\Facades\Route::has($menu->route) ? route($menu->route) : '#' }}"
                                        wire:navigate
                                    @endif>
                                    <span>
                                        <span class="sidebar-icon">
                                            <i class="{{ $menu->icon }}"></i>
                                        </span>
                                        <span class="sidebar-text">
                                            {{ $menu->name }}
                                        </span>
                                    </span>
                                    @if($hasChild)
                                        <span class="link-arrow">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    @endif
                                </a>

                                {{-- Check if has child --}}
                                @if($hasChild && $menu->type != 'header')
                                    <div
                                        id="menu-{{ \Illuminate\Support\Str::slug($menu->name, '-') }}"
                                        class="multi-level collapse {{ $isActive ? 'show' : '' }}"
                                        role="list">
                                        <ul class="flex-column nav">
                                            {{-- Loop child --}}
                                            @foreach ($menu->menuChildren as $children)
                                                @can('view.'.$children->route)
                                                    @php
                                                        $childIsActive = request()->routeIs($children->route) || str_contains(request()->path(), strtolower($children->name));
                                                    @endphp
                                                    <li class="nav-item {{ $childIsActive ? 'active' : '' }}">
                                                        <a class="nav-link" href="{{
                                                            \Illuminate\Support\Facades\Route::has($children->route)
                                                            ? route($children->route)
                                                            : '#'
                                                        }}" wire:navigate>
                                                            <span class="sidebar-text">
                                                                @if($children->icon != '#')
                                                                    <i class="{{ $children->icon }}"></i>
                                                                @endif
                                                                {{ $children->name }}
                                                            </span>
                                                        </a>
                                                    </li>
                                                @endcan
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </li>
                        @endif
                    @endif
                @else

                @endif
            @endforeach
            {{-- <li role="separator" class="dropdown-divider mt-4 mb-3 border-gray-700"></li>
            <li class="nav-item">
                <a href="https://themesberg.com" target="_blank" class="nav-link d-flex align-items-center">
                    <span class="sidebar-icon">
                        <img src="{{ asset('admin/img/themesberg.svg') }}" height="20" width="28"
                            alt="Themesberg Logo">
                    </span>
                    <span class="sidebar-text">Themesberg</span>
                </a>
            </li> --}}
        </ul>
    </div>
</nav>
