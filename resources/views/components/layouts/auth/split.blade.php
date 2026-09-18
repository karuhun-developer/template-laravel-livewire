<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('components.layouts.partials.head')
        @livewireStyles
    </head>
    <body class="min-h-screen bg-canvas text-ink-950 antialiased dark:bg-[#080e1a] dark:text-zinc-100">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <!-- Left HydroBento Branding Column -->
            <div class="relative hidden h-full flex-col justify-between p-10 text-white lg:flex border-e border-[#222c3d] bg-[#161c28] overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_90%_10%,rgb(0_226_157/0.14),transparent_30rem)] pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 size-96 rounded-full bg-[#1e667f]/20 blur-3xl pointer-events-none"></div>

                <a href="{{ route('home') }}" class="relative z-20 flex items-center gap-3 text-lg font-semibold tracking-tight text-white" wire:navigate>
                    <div class="flex aspect-square size-10 items-center justify-center rounded-xl bg-electric-mint text-[#161c28] shadow-sm">
                        <x-app-logo-icon class="size-6 fill-current text-[#161c28]" />
                    </div>
                    <span class="font-display tracking-tight text-xl font-bold">{{ config('app.name', 'Laravel') }}</span>
                </a>

                @php
                    [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                @endphp

                <div class="relative z-20 mt-auto">
                    <blockquote class="space-y-3 rounded-2xl border border-[#222c3d] bg-[#080e1a]/70 p-6 backdrop-blur-md">
                        <flux:heading size="lg" class="text-white font-display leading-relaxed font-semibold">&ldquo;{{ trim($message) }}&rdquo;</flux:heading>
                        <footer><span class="text-xs font-bold uppercase tracking-wider text-electric-mint font-display">{{ trim($author) }}</span></footer>
                    </blockquote>
                </div>
            </div>

            <!-- Right Form Column -->
            <div class="w-full lg:p-8">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[380px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-3 font-medium lg:hidden" wire:navigate>
                        <div class="flex aspect-square size-12 items-center justify-center rounded-2xl bg-electric-mint text-[#161c28] shadow-sm">
                            <x-app-logo-icon class="size-7 fill-current text-[#161c28]" />
                        </div>
                        <span class="text-2xl font-bold font-display text-ink-950 dark:text-white tracking-tight">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                    <div class="rounded-2xl border border-line bg-surface p-6 sm:p-8 shadow-sm dark:border-[#222c3d] dark:bg-[#121824]">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        @livewireScriptConfig
        @fluxScripts
    </body>
</html>
