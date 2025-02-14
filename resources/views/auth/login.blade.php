<x-layouts.auth>
    <x-slot:title>
        Sign In
    </x-slot:title>
    <x-slot:image>
        <img src="{{ asset('img/sign-in.png') }}" class="img d-block mx-auto" alt="Sign in" height="400" />
    </x-slot:image>
    <div class="text-center">
        <a href="#" class="navbar-brand navbar-brand-autodark">
            @if($settings->getFirstMediaUrl('logo') != '')
                <img src="{{ $settings->getFirstMediaUrl('logo') }}" class="navbar-brand-image" alt="{{ $settings->name }}" />
            @else
                <img src="{{ asset('img/logo.svg') }}" class="navbar-brand-image" alt="{{ $settings->name }}" />
            @endif
        </a>
    </div>
    <div class="card card-md mt-5">
        <div class="card-body">
            <h2 class="h2 text-center mb-4">Login to your account</h2>
            <form action="{{ route('login') }}" method="post" class="mt-4" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <x-acc-input type="email"
                        model="email"
                        autofocus
                        autocomplete="email"
                        placeholder="your@email.com"
                        :livewire="false"
                        old="{{ old('email') }}"
                        icon="fas fa-envelope"
                    />
                </div>
                <div class="mb-2">
                    <label class="form-label">
                        Password
                        @if (Route::has('password.request'))
                            <span class="form-label-description">
                                <a href="{{ route('password.request') }}">I forgot password</a>
                            </span>
                        @endif
                    </label>
                    <x-acc-input type="password"
                        model="password"
                        placeholder="********"
                        :livewire="false"
                        icon="fas fa-lock"
                    />
                </div>
                <div class="mb-2">
                    <label class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" />
                        <span class="form-check-label">Remember me</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign in</button>
                </div>
            </form>
        </div>
        {{-- <div class="hr-text">or</div> --}}
    </div>
    <div class="text-center text-secondary mt-3">
        @if (Route::has('register'))
            <div class="mt-3 small text-right">
                Don't have account yet?
                <a href="{{ route('register') }}" tabindex="-1">
                    Sign up
                </a>
            </div>
        @endif
    </div>
</x-layouts.auth>
