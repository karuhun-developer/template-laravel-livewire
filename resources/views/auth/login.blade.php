<x-layouts.auth>
    <x-slot:title>
        Sign In
    </x-slot:title>
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            {{-- <p class="text-center">
                <a href="#" class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-angle-left me-2"></i>
                    Back to homepage
                </a>
            </p> --}}
            <div class="row justify-content-center form-bg-image" data-background-lg="{{ asset('admin/img/illustrations/signin.svg') }}">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            @if($settings->getFirstMediaUrl('logo') != '')
                                <img src="{{ $settings->getFirstMediaUrl('logo') }}" class="img-fluid" style="width: 400px">
                            @else
                                <h1 class="mb-0 h3">Sign in to continue</h1>
                            @endif
                        </div>
                        <form action="{{ route('login') }}" method="post" class="mt-4">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="email">Your Email</label>
                                <x-acc-input type="email"
                                    model="email"
                                    autofocus
                                    autocomplete="email"
                                    placeholder="Enter your email"
                                    :livewire="false"
                                    old="{{ old('email') }}"
                                    icon="fas fa-envelope"
                                />
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password">Your Password</label>
                                    <x-acc-input type="password"
                                        model="password"
                                        placeholder="********"
                                        :livewire="false"
                                        icon="fas fa-lock"
                                    />
                                </div>
                                <!-- End of Form -->
                                <div class="d-flex justify-content-between align-items-top mb-4">
                                    <div class="form-check">
                                        <input type="checkbox"
                                            name="remember"
                                            class="form-check-input"
                                            placeholder="********"
                                        />
                                        <label class="form-check-label mb-0" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <div>
                                            <a href="{{ route('password.request') }}" class="small text-right">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">
                                    Sign in
                                </button>
                            </div>
                            @if (Route::has('register'))
                                <div class="mt-3 small text-right">
                                    Don't have an account?
                                    <a href="{{ route('register') }}">
                                        Sign up
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.auth>
