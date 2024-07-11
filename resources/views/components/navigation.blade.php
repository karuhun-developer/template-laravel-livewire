<div>
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
                        @can('view.'.$menu->route)
                            <li class="sidebar-{{ $menu->type }} {{ $isActive ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{
                                    \Illuminate\Support\Facades\Route::has($menu->route)
                                    ? route($menu->route)
                                    : '#'
                                }}">
                                    @if($menu->type != 'header')
                                        <i class="align-middle" data-feather="{{ $menu->icon }}"></i>
                                    @endif
                                    <span class="align-middle">{{ $menu->name }}</span>
                                </a>
                            </li>
                        @endcan
                    @elseif(!auth()->user()->hasRole('receptionist'))
                        <li class="sidebar-header">{{ $menu->name }}</li>
                    @endif
                @endforeach
                {{--
                    Dropdown menus
                    <li class="sidebar-item active">
                        <a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg> <span class="align-middle">Dashboards</span>
                        </a>
                        <!-- add class show -->
                        <ul id="dashboards" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                            <li class="sidebar-item active"><a class="sidebar-link" href="/">Analytics</a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="/dashboard-ecommerce">E-Commerce <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                            <li class="sidebar-item"><a class="sidebar-link" href="/dashboard-crypto">Crypto <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
                        </ul>
                    </li>
                --}}
            </ul>
        </div>
    </nav>
</div>
