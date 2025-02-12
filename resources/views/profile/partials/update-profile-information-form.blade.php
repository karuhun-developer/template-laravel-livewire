<section>
    <header>
        <h2>
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mb-5">
        @csrf
        @method('patch')

        <div class="row">
            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ __('Saved.') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-12 mb-3">
                <label class="form-label">Name</label>
                <x-acc-input
                    model="name"
                    autofocus
                    :livewire="false"
                    old="{{ old('name', $user->name) }}"
                    icon="fas fa-user"
                />
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Email</label>
                <x-acc-input
                    type="email"
                    model="email"
                    :livewire="false"
                    old="{{ old('email', $user->email) }}"
                    icon="fas fa-envelope"
                />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                        @csrf
                    </form>
                    <div>
                        <p class="text-sm mt-2">
                            {{ __('Your email address is unverified.') }}

                            <button form="send-verification" class="btn btn-primary">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-success">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                </div>
            </div>
        </div>
    </form>
</section>
