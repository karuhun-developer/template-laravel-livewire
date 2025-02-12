<x-layouts.auth>
    <x-slot:title>
        Sign Up
    </x-slot:title>
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <p class="text-center">
                <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                    <i class="fas fa-angle-left me-2"></i>
                    Back to login
                </a>
            </p>
            <div class="row justify-content-center form-bg-image" data-background-lg="{{ asset('admin/img/illustrations/signin.svg') }}">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">Sign up to continue</h1>
                        </div>
                        <form action="{{ route('register') }}" class="mt-4">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="name">Your Name</label>
                                <x-acc-input type="name"
                                    model="name"
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Enter your name"
                                    :livewire="false"
                                    old="{{ old('name') }}"
                                    icon="fas fa-user"
                                />
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">Your Email</label>
                                <x-acc-input type="email"
                                    model="email"
                                    autocomplete="email"
                                    placeholder="Enter your email"
                                    :livewire="false"
                                    old="{{ old('email') }}"
                                    icon="fas fa-envelope"
                                />
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <x-acc-input type="password"
                                    model="password"
                                    autocomplete="new-password"
                                    placeholder="Enter your password"
                                    :livewire="false"
                                    icon="fas fa-key"
                                />
                            </div>
                            <div class="form-group mb-4">
                                <label for="password_confirmation">Confirm Password</label>
                                <x-acc-input type="password"
                                    model="password_confirmation"
                                    autocomplete="new-password"
                                    placeholder="Confirm your password"
                                    :livewire="false"
                                    icon="fas fa-key"
                                />
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800">
                                    Sign Up
                                </button>
                            </div>
                            <div class="mt-3 small text-right">
                                Already have an account?
                                <a href="{{ route('login') }}">
                                    Sign in
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.auth>
