<x-layouts.auth>
    <x-slot:title>
        LOGIN
    </x-slot:title>
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <h1 class="h2">Welcome back!</h1>
                        <p class="lead">
                            Sign in to your account to continue
                        </p>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="m-sm-3">
                                <form method="POST" action="{{ route('register') }}">
                                    @csrf

                                    <!-- Name -->
                                    <div>
                                        <label class="form-label">Name</label>
                                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                                        <x-acc-input-error for="name" />
                                    </div>

                                    <!-- Email Address -->
                                    <div class="mt-4">
                                        <label class="form-label">Email</label>
                                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                                        <x-acc-input-error for="email" />
                                    </div>

                                    <!-- Password -->
                                    <div class="mt-4">
                                        <label class="form-label">Password</label>

                                        <input id="password" class="form-control"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="new-password" />

                                        <x-acc-input-error for="password" />
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mt-4">
                                        <label class="form-label">Confirm Password</label>

                                        <input id="password_confirmation" class="form-control"
                                                        type="password"
                                                        name="password_confirmation" required autocomplete="new-password" />

                                        <x-acc-input-error for="password_confirmation" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <a href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>

                                        <button class="btn btn-primary float-end">
                                            {{ __('Register') }}
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
