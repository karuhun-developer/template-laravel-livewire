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
            <div class="col-md-12 mb-3">
                <label class="form-label">Name</label>
                <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
                <x-acc-input-error for="name" />
            </div>
            <div class="col-md-12 mb-3">
                <label class="form-label">Email</label>
                <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
                <x-acc-input-error for="email" />

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

                @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-success text-lg"
                    >{{ __('Saved.') }}</p>
                @endif
                </div>
            </div>
        </div>


    </form>
</section>
