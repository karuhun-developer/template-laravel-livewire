<section class="space-y-6" x-data x-init="
    if({{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }}) {
        new bootstrap.Modal(document.getElementById('acc-modal')).show()
    }
">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button class="btn btn-danger"
        x-data
        @click="new bootstrap.Modal(document.getElementById('acc-modal')).show()"
    >{{ __('Delete Account') }}</button>

    <x-acc-modal title="" focusable>
        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <label class="form-label">Password</label>

                <input
                    id="delete-password"
                    name="password"
                    type="password"
                    class="form-control"
                    required
                    placeholder="{{ __('Password') }}"
                />

                <div>
                    @if($errors->userDeletion->get('password'))
                        <span class="text-danger text-sm">{{ $errors->userDeletion->get('password')[0] }}</span>
                    @endif
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">
                    {{ __('Cancel') }}
                </button>

                <button class="btn btn-danger ml-3">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-acc-modal>
</section>
