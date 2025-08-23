<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-1 space-y-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label class="form-label fw-bold">
                Name
            </label>
            <x-acc-input
                model="name"
                :old="old('name', $user->name)"
                :livewire="false"
            />
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">
                Email
            </label>
            <x-acc-input
                type="email"
                model="email"
                :old="old('email', $user->email)"
                :livewire="false"
            />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-sm bg-gradient-dark mt-4 mb-0">
                <i class="fas fa-save me-2"></i>
                Save
            </button>
        </div>
    </form>
</section>
