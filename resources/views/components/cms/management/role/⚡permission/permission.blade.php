<div>
    <div class="grid grid-cols-1">
        <div class="col-span-1">
            <div class="my-3 rounded-lg bg-white shadow-sm dark:bg-zinc-800">
                <div class="border-b border-gray-200 p-6 dark:border-zinc-700">
                    <div class="lg:flex lg:items-center lg:justify-between">
                        <div class="mt-4 lg:mt-0 lg:ml-auto">
                            <div class="flex gap-2">
                                <flux:button
                                    variant="primary"
                                    icon="check"
                                    @click="
                                        $wire.checkAll();
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1000);
                                    "
                                >
                                    Check All
                                </flux:button>
                                <flux:button
                                    variant="danger"
                                    icon="x-mark"
                                    @click="
                                        $wire.uncheckAll();
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1000);
                                    "
                                >
                                    Uncheck All
                                </flux:button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        @foreach ($permissions as $route => $type)
                            <div class="w-full">
                                <h5 class="mb-4 text-base font-semibold text-gray-900 dark:text-white">
                                    Route: {{ $route }}
                                </h5>
                                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                                    @foreach ($type as $name => $value)
                                        @php
                                            $label = explode('.', $name);
                                            $label = $label[0];
                                        @endphp
                                        <div class="flex items-center">
                                            <div
                                                class="flex items-center"
                                                x-data="{ check: {{ $value ? 'true' : 'false' }} }"
                                                x-init="$watch('check', value => {
                                                    $wire.{{ $value ? 'uncheck' : 'check' }}('{{ $name }}', '{{ str_replace('\\', '\\\\', $route) }}');
                                                });"
                                            >
                                                <input
                                                    class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 disabled:opacity-50 dark:border-zinc-600 dark:bg-zinc-700 dark:ring-offset-zinc-800 dark:focus:ring-blue-600"
                                                    type="checkbox"
                                                    x-model="check"
                                                    wire:loading.attr="disabled"
                                                />
                                                <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                                    {{ ucfirst($label) }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
