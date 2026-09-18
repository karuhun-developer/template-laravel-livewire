<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.layouts.partials.head')
        @livewireStyles
    </head>
    <body class="min-h-screen bg-canvas text-ink-950 antialiased dark:bg-[#080e1a] dark:text-zinc-100">
        <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-sm flex-col gap-6">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                    <div class="flex aspect-square size-12 items-center justify-center rounded-2xl bg-electric-mint text-[#161c28] shadow-sm">
                        <x-app-logo-icon class="size-7 fill-current text-[#161c28]" />
                    </div>
                    <span class="text-2xl font-bold font-display text-ink-950 dark:text-white tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                </a>
                <div class="flex flex-col gap-6">
                    {{ $slot }}
                </div>
            </div>
        </div>
        @livewireScriptConfig
        @fluxScripts
    </body>
</html>
