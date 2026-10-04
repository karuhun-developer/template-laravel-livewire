<x-layouts.auth title="Page Not Found">
    <div class="flex min-h-screen flex-col items-center justify-center">
        <h1 class="mb-4 text-6xl font-bold text-gray-800 dark:text-gray-100">404</h1>
        <flux:text class="text-lg"> Oops! The page you're looking for doesn't exist. </flux:text>

        <flux:button href="{{ url()->previous() }}" variant="primary" icon="arrow-left" class="mt-5">
            Go Back
        </flux:button>
    </div>
</x-layouts.auth>
