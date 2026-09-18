<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.layouts.partials.head')
        @livewireStyles
    </head>
    <body class="min-h-screen bg-canvas text-ink-950 antialiased dark:bg-[#080e1a] dark:text-zinc-100">
        <flux:sidebar sticky collapsible class="border-e border-[#222c3d] bg-[#161c28] text-white dark:border-[#1e293b] dark:bg-[#080e1a]">
            <flux:sidebar.header>
                <flux:sidebar.brand
                    href="{{ route('cms.dashboard') }}"
                    :name="config('app.name', 'Laravel')"
                    class="!text-white *:!text-white font-display font-bold"
                >
                    <x-slot name="logo">
                        <div class="flex aspect-square size-7 items-center justify-center rounded-md bg-electric-mint text-[#161c28] shadow-xs">
                            <x-app-logo-icon class="size-4 fill-current text-[#161c28]" />
                        </div>
                    </x-slot>
                </flux:sidebar.brand>
                <flux:sidebar.collapse class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2 text-zinc-400 hover:text-white" />
            </flux:sidebar.header>

            @php
                if (! function_exists('menuActive')) {
                    function menuActive(array $activeRoute = []): bool {
                        // Check if route name contains the active route
                        foreach ($activeRoute as $route) {
                            if(str_contains(request()->route()->getName(), $route) || request()->routeIs($route)) {
                                return true;
                                break;
                            }
                        }

                        return false;
                    }
                }

                if (! function_exists('showDropdown')) {
                    // Show dropdown menu if the route is active
                    function showDropdown($activeRoute = []): bool {
                        foreach ($activeRoute as $route) {
                            if(str_contains(request()->route()->getName(), $route) || request()->routeIs($route)) {
                                return true;
                                break;
                            }
                        }

                        return false;
                    }
                }

                if (! function_exists('echoRoute')) {
                    // Echo route
                    function echoRoute($url) {
                        try {
                            return route($url);
                        } catch (\Exception $e) {
                            return '#';
                        }
                    }
                }

                // Check user roles
                $listMenus = getMenus();
            @endphp
            <flux:sidebar.nav>
                @foreach($listMenus as $mainMenu)
                    @if(count($mainMenu->subMenu) > 0)
                        <flux:sidebar.group
                            heading="{{ $mainMenu->name }}"
                            expandable
                            :expanded="showDropdown(explode(',', $mainMenu->active_pattern))">
                            @if ($mainMenu->icon)
                                <x-slot name="icon">
                                    <flux:icon name="{{ $mainMenu->icon }}" variant="micro" />
                                </x-slot>
                            @endif
                            @foreach($mainMenu->subMenu as $child)
                                <flux:sidebar.item
                                    href="{{ echoRoute($child->url) }}"
                                    :current="menuActive(explode(',', $child->active_pattern))"
                                    wire:navigate>
                                    {{ $child->name }}
                                </flux:sidebar.item>
                            @endforeach
                        </flux:sidebar.group>
                    @else
                        <flux:sidebar.item
                            icon="{{ $mainMenu->icon }}"
                            href="{{ echoRoute($mainMenu->url) }}"
                            :current="menuActive(explode(',', $mainMenu->active_pattern))"
                            wire:navigate>
                            {{ $mainMenu->name }}
                        </flux:sidebar.item>
                    @endif
                @endforeach
            </flux:sidebar.nav>

            <flux:spacer />

            <flux:sidebar.nav variant="outline">
                @role('superadmin')
                    <flux:sidebar.item icon="screen-share" href="{{ url('pulse') }}" target="_blank">
                        Laravel Pulse
                    </flux:sidebar.item>

                    <flux:sidebar.item icon="scroll-text" href="{{ url('logs') }}" target="_blank">
                        Laravel Logs
                    </flux:sidebar.item>
                @endrole
            </flux:sidebar.nav>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-[#293344] text-electric-mint font-semibold font-display"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden border-b border-line bg-surface/90 backdrop-blur-md dark:border-[#222c3d] dark:bg-[#121824]/90">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-[#293344] text-electric-mint font-semibold font-display"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @livewireScriptConfig
        @fluxScripts
    </body>
</html>
