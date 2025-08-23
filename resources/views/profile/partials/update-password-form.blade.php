<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-1 space-y-6">
        @csrf
        @method('put')

        <div class="mb-3">
            <label class="form-label fw-bold">
                Current Password
            </label>
            <x-acc-input
                type="password"
                model="current_password"
                placeholder="Enter your current password"
                :livewire="false"
            />
            <div>
                @if($errors->updatePassword->get('current_password'))
                    <span class="text-danger text-sm">{{ $errors->updatePassword->get('current_password')[0] }}</span>
                @endif
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">
                New Password
            </label>
            <x-acc-input
                type="password"
                model="password"
                placeholder="Enter your new password"
                :livewire="false"
            />
            <div>
                @if($errors->updatePassword->get('password'))
                    <span class="text-danger text-sm">{{ $errors->updatePassword->get('password')[0] }}</span>
                @endif
            </div>
        </div>

        <div>
            <label class="form-label fw-bold">
                Confirm New Password
            </label>
            <x-acc-input
                type="password"
                model="password_confirmation"
                placeholder="Confirm your new password"
                :livewire="false"
            />
            <div>
                @if($errors->updatePassword->get('password_confirmation'))
                    <span class="text-danger text-sm">{{ $errors->updatePassword->get('password_confirmation')[0] }}</span>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="btn btn-sm bg-gradient-dark mt-4 mb-0">
                <i class="fa fa-save me-2"></i>
                Save
            </button>
        </div>
    </form>
</section>
