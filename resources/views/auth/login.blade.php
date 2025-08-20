<x-layouts.guest>
    <x-slot:title>
        Sign In
    </x-slot:title>
    <div class="row">
        <div
            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                style="
                    background-image: url('{{ asset('cassets/img/illustrations/illustration-signin.jpg') }}');
                    background-size: cover;
                ">
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
            <div class="card card-plain">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Sign In</h4>
                    <p class="mb-0">Enter your email and password to sign in</p>
                </div>
                <div class="card-body">
                    <x-acc-alert session="status" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <x-acc-input type="email"
                                model="email"
                                label="Email"
                                autofocus
                                autocomplete="email"
                                :livewire="false"
                                old="{{ old('email') }}"
                            />
                        </div>
                        <div class="mb-3">
                            <x-acc-input type="password"
                                model="password"
                                label="Password"
                                :livewire="false"
                            />
                            @if (Route::has('password.request'))
                                <a class="text-primary text-gradient font-weight-bold text-sm float-end" href="{{ route('password.request') }}">
                                    Forgot your password?
                                </a>
                            @endif
                        </div>
                        <div class="form-check form-check-info text-start ps-0">
                            <input class="form-check-input"
                                type="checkbox"
                                id="remember"
                                required
                                name="remember"
                                {{ old('remember') ? 'checked' : '' }}
                                checked
                            />
                            <label class="form-check-label" for="flexCheckDefault">
                                Remember me
                            </label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">
                                <i class="fa fa-sign-in me-2"></i>
                                Sign In
                            </button>
                        </div>
                    </form>
                </div>
                @if (Route::has('register'))
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mb-2 text-sm mx-auto">
                            Doesn't have an account?
                            <a href="{{ route('register') }}" class="text-primary text-gradient font-weight-bold">
                                Register
                            </a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.guest>
