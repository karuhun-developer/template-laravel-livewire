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
                <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" />
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
                <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" />
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
                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" />
                @if($errors->updatePassword->get('password_confirmation'))
                        <span class="text-danger text-sm">{{ $errors->updatePassword->get('password_confirmation')[0] }}</span>
                    @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

                @if (session('status') === 'password-updated')
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
    </form>
</section>
