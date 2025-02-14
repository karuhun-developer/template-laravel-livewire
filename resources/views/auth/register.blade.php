<x-layouts.auth>
    <x-slot:title>
        Sign Up
    </x-slot:title>
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
            <h2 class="h2 text-center mb-4">Create new account</h2>
            <form action="{{ route('register') }}" method="post" class="mt-4" novalidate>
                @csrf
                <div class="mb-3">
                    <label class="form-label">Full name</label>
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
                    <label class="form-label">Password</label>
                    <x-acc-input type="password"
                        model="password"
                        placeholder="********"
                        :livewire="false"
                        icon="fas fa-lock"
                    />
                </div>
                <div class="mb-2">
                    <label class="form-label">Confirm Password</label>
                    <x-acc-input type="password"
                        model="password_confirmation"
                        autocomplete="new-password"
                        placeholder="Confirm your password"
                        :livewire="false"
                        icon="fas fa-key"
                    />
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-3 small text-right">
        Already have an account?
        <a href="{{ route('login') }}">
            Sign in
        </a>
    </div>
</x-layouts.auth>
