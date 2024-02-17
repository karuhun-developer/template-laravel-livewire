<div>
    <nav id="sidebar" class="sidebar js-sidebar">
        <div class="sidebar-content js-simplebar">
            <a class="sidebar-brand" href="{{ route('cms.dashboard') }}">
                <span class="align-middle">{{ $settings->name }}</span>
            </a>

            <ul class="sidebar-nav">
                @foreach($menus as $menu)
                    @if($menu->type != 'header')
                        @can('view.'.$menu->route)
                            <li class="sidebar-{{ $menu->type }}">
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
            </ul>
        </div>
    </nav>
</div>
