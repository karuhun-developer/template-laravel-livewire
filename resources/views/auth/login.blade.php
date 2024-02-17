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
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input
                                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                                            type="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            required
                                            autocomplete="email"
                                            autofocus
                                            placeholder="Enter your email"
                                        />


                                        <x-acc-input-error for="email" />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input
                                            type="password"
                                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                                            name="password"
                                            required
                                            autocomplete="current-password"
                                            placeholder="Enter your password"
                                        />

                                        <x-acc-input-error for="password" />
                                    </div>
                                    <div>
                                        <div class="form-check align-items-center">
                                            <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                            <label class="form-check-label text-small" for="remember">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif

                                        <button type="submit" class="btn btn-primary float-end">
                                            {{ __('Login') }}
                                        </button>
                                    </div>
                                </form>

                                <div class="flex items-center justify-end mt-4">
                                    @if (Route::has('register'))
                                        {{ __("Don't have an account ?") }}
                                        <a href="{{ route('register') }}">
                                            {{ __('Register') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
