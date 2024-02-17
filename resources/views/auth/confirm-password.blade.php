<x-layouts.auth>
    <x-slot:title>
        CONFIRM PASSWORD
    </x-slot:title>
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <p class="lead">
                            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form method="POST" action="{{ route('password.confirm') }}">
                                    @csrf

                                    <!-- Password -->
                                    <div>
                                        <label class="form-label">Password</label>

                                        <input id="password" class="form-control"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="current-password" />

                                        <x-acc-input-error for="password" />
                                    </div>

                                    <div class="flex justify-end mt-4">
                                        <button class="btn btn-primary">
                                            {{ __('Confirm') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
