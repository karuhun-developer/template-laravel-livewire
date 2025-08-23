<x-layouts.cms>
    <div class="py-0">
        @php
            $message = match(session('status')) {
                'profile-updated' => 'Profile updated successfully.',
                'password-updated' => 'Password updated successfully.',
                'two-factor-authentication-enabled' => 'Two factor authentication enabled.',
                'two-factor-authentication-disabled' => 'Two factor authentication disabled.',
                'recovery-codes-generated' => 'Recovery codes generated successfully.',
                'browser-sessions-logged-out' => 'Browser sessions logged out successfully.',
                default => null,
            };
        @endphp
        <x-acc-custom-alert session="status" :message="$message" />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-layouts.cms>
