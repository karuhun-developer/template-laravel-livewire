<section>
    <header>
        <h2>
            {{ __('Update Password') }}
        </h2>

        <p>
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mb-5">
        @csrf
        @method('put')

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="form-label">Current Password</label>
                <x-acc-input
                    type="password"
                    model="current_password"
                    placeholder="Enter your current password"
                    :livewire="false"
                    icon="fas fa-key"
                />
                <div>
                    @if($errors->updatePassword->get('current_password'))
                        <span class="text-danger text-sm">{{ $errors->updatePassword->get('current_password')[0] }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="form-label">New Password</label>
                <x-acc-input
                    type="password"
                    model="password"
                    placeholder="Enter your new password"
                    :livewire="false"
                    icon="fas fa-key"
                />
                <div>
                    @if($errors->updatePassword->get('password'))
                        <span class="text-danger text-sm">{{ $errors->updatePassword->get('password')[0] }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="form-label">Confirm Password</label>
                <x-acc-input
                    type="password"
                    model="password_confirmation"
                    placeholder="Confirm your new password"
                    :livewire="false"
                    icon="fas fa-key"
                />
                <div>
                    @if($errors->updatePassword->get('password_confirmation'))
                        <span class="text-danger text-sm">{{ $errors->updatePassword->get('password_confirmation')[0] }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                @if (session('status') === 'password-updated')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ __('Saved.') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
        </div>
    </form>
</section>
