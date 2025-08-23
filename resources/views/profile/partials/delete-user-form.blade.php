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

    <button class="btn btn-sm btn-danger"
        x-data
        @click="new bootstrap.Modal(document.getElementById('acc-modal')).show()"
    >
        <i class="fa fa-trash me-2"></i>
        Delete Account
    </button>

    <div class="modal fade show mt-5" id="acc-modal" tabindex="-1" aria-labelledby="acc-modal-label" aria-hidden="true" focusable>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="acc-modal-label">Delete Account</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div>
                            <label class="form-label fw-bold">
                                Password
                            </label>
                            <x-acc-input
                                type="password"
                                model="password"
                                placeholder="Enter your new password"
                                :livewire="false"
                            />
                            <div>
                                @if($errors->userDeletion->get('password'))
                                    <span class="text-danger text-sm">{{ $errors->userDeletion->get('password')[0] }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mt-3 flex justify-end">
                            <button class="btn bg-gradient-dark btn-sm" type="button" data-bs-dismiss="modal">
                                <i class="fa fa-times me-2"></i>
                                {{ __('Cancel') }}
                            </button>

                            <button class="btn btn-sm btn-danger ml-3">
                                <i class="fa fa-trash me-2"></i>
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
