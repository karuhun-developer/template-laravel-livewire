<section class="w-full">
    <x-setting.heading />
    <x-setting.layout
        :heading="__('Two Factor Authentication')"
        :subheading="__('Manage your two-factor authentication settings')"
    >
        <div class="mx-auto flex w-full flex-col space-y-6 text-sm" wire:cloak>
            @if ($twoFactorEnabled)
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <flux:badge color="green">{{ __('Enabled') }}</flux:badge>
                    </div>

                    <flux:text>
                        {{ __('With two-factor authentication enabled, you will be prompted for a secure, random pin during login, which you can retrieve from the TOTP-supported application on your phone.') }}
                    </flux:text>

                    <livewire:setting.two-factor.recovery-codes :$requiresConfirmation />

                    <div class="flex justify-start">
                        <flux:button
                            variant="danger"
                            icon="shield-exclamation"
                            icon:variant="outline"
                            wire:click="disable"
                        >
                            {{ __('Disable 2FA') }}
                        </flux:button>
                    </div>
                </div>
            @else
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <flux:badge color="red">{{ __('Disabled') }}</flux:badge>
                    </div>

                    <flux:text variant="subtle">
                        {{ __('When you enable two-factor authentication, you will be prompted for a secure pin during login. This pin can be retrieved from a TOTP-supported application on your phone.') }}
                    </flux:text>

                    <flux:button variant="primary" icon="shield-check" icon:variant="outline" wire:click="enable">
                        {{ __('Enable 2FA') }}
                    </flux:button>
                </div>
            @endif
        </div>
    </x-setting.layout>

    <flux:modal name="two-factor-setup-modal" class="max-w-md md:min-w-md" wire:model="showModal">
        <div class="space-y-6">
            <div class="flex flex-col items-center space-y-4">
                <div class="w-auto rounded-full border border-stone-100 bg-white p-0.5 shadow-sm dark:border-stone-600 dark:bg-stone-800">
                    <div class="relative overflow-hidden rounded-full border border-stone-200 bg-stone-100 p-2.5 dark:border-stone-600 dark:bg-stone-200">
                        <div class="[&>div]:flex-1 absolute inset-0 flex h-full w-full items-stretch justify-around divide-x divide-stone-200 opacity-50 dark:divide-stone-300">
                            @for ($i = 1; $i <= 5; $i++)
                                <div></div>
                            @endfor
                        </div>

                        <div class="[&>div]:flex-1 absolute inset-0 flex h-full w-full flex-col items-stretch justify-around divide-y divide-stone-200 opacity-50 dark:divide-stone-300">
                            @for ($i = 1; $i <= 5; $i++)
                                <div></div>
                            @endfor
                        </div>

                        <flux:icon.qr-code class="dark:text-accent-foreground relative z-20" />
                    </div>
                </div>

                <div class="space-y-2 text-center">
                    <flux:heading size="lg">{{ $this->modalConfig['title'] }}</flux:heading>
                    <flux:text>{{ $this->modalConfig['description'] }}</flux:text>
                </div>
            </div>

            @if ($showVerificationStep)
                <div class="space-y-6">
                    <div class="flex flex-col items-center space-y-3">
                        <x-ui.auth.input-otp :digits="6" name="code" wire:model="code" autocomplete="one-time-code" />
                        @error('code')
                            <flux:text color="red"> {{ $message }} </flux:text>
                        @enderror
                    </div>

                    <div class="flex items-center space-x-3">
                        <flux:button variant="outline" class="flex-1" wire:click="resetVerification">
                            {{ __('Back') }}
                        </flux:button>

                        <flux:button
                            variant="primary"
                            class="flex-1"
                            wire:click="confirmTwoFactor"
                            x-bind:disabled="$wire.code.length < 6"
                        >
                            {{ __('Confirm') }}
                        </flux:button>
                    </div>
                </div>
            @else
                @error('setupData')
                    <flux:callout variant="danger" icon="x-circle" heading="{{ $message }}" />
                @enderror

                <div class="flex justify-center">
                    <div class="relative aspect-square w-64 overflow-hidden rounded-lg border border-stone-200 dark:border-stone-700">
                        @empty($qrCodeSvg)
                            <div class="absolute inset-0 flex animate-pulse items-center justify-center bg-white dark:bg-stone-700">
                                <flux:icon.loading />
                            </div>
                        @else
                            <div class="flex h-full items-center justify-center p-4">
                                <div class="rounded bg-white p-3">{!! $qrCodeSvg !!}</div>
                            </div>
                        @endempty
                    </div>
                </div>

                <div>
                    <flux:button
                        :disabled="$errors->has('setupData')"
                        variant="primary"
                        class="w-full"
                        wire:click="showVerificationIfNecessary"
                    >
                        {{ $this->modalConfig['buttonText'] }}
                    </flux:button>
                </div>

                <div class="space-y-4">
                    <div class="relative flex w-full items-center justify-center">
                        <div class="absolute inset-0 top-1/2 h-px w-full bg-stone-200 dark:bg-stone-600"></div>
                        <span class="relative bg-white px-2 text-sm text-stone-600 dark:bg-stone-800 dark:text-stone-400">
                            {{ __('or, enter the code manually') }}
                        </span>
                    </div>

                    <div
                        class="flex items-center space-x-2"
                        x-data="{
                            copied: false,
                            async copy() {
                                try {
                                    await navigator.clipboard.writeText('{{ $manualSetupKey }}');
                                    this.copied = true;
                                    setTimeout(() => this.copied = false, 1500);
                                } catch (e) {
                                    console.warn('Could not copy to clipboard');
                                }
                            }
                        }"
                    >
                        <div class="flex w-full items-stretch rounded-xl border dark:border-stone-700">
                            @empty($manualSetupKey)
                                <div class="flex w-full items-center justify-center bg-stone-100 p-3 dark:bg-stone-700">
                                    <flux:icon.loading variant="mini" />
                                </div>
                            @else
                                <input
                                    type="text"
                                    readonly
                                    value="{{ $manualSetupKey }}"
                                    class="w-full bg-transparent p-3 text-stone-900 outline-none dark:text-stone-100"
                                />

                                <button
                                    @click="copy()"
                                    class="cursor-pointer border-l border-stone-200 px-3 transition-colors dark:border-stone-600"
                                >
                                    <flux:icon.document-duplicate x-show="! copied" variant="outline">
                                        </flux:icon>
                                        <flux:icon.check x-show="copied" variant="solid" class="text-green-500">
                                            </flux:icon>
                                </button>
                            @endempty
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </flux:modal>
</section>
