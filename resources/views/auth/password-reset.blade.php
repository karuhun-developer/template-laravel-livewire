<x-layouts.auth>
    <x-slot:title>
        Reset Password
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
            <h2 class="h2 text-center mb-4">Reset Your Password</h2>
            <form action="{{ route('password.store') }}" method="post" class="mt-4" novalidate>
                <input type="hidden" name="token" value="{{ $token }}">
                @csrf
                <x-acc-alert session="status" />
                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <x-acc-input type="email"
                        model="email"
                        autofocus
                        autocomplete="email"
                        placeholder="your@email.com"
                        :livewire="false"
                        old="{{ old('email', $request->email) }}"
                        icon="fas fa-envelope"
                    />
                </div>
                <div class="mb-2">
                    <label class="form-label"> Password </label>
                    <x-acc-input type="password"
                        model="password"
                        placeholder="********"
                        :livewire="false"
                        icon="fas fa-lock"
                    />
                </div>
                <div class="mb-2">
                    <label class="form-label"> Password Confirmation </label>
                    <x-acc-input type="password"
                        model="password_confirmation"
                        placeholder="********"
                        :livewire="false"
                        icon="fas fa-lock"
                    />
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Reset Password</button>
                </div>
            </form>
        </div>
        {{-- <div class="hr-text">or</div> --}}
    </div>
</x-layouts.auth>
