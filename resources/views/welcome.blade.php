<x-layouts.auth>
    <x-slot:title>
        Welcome to {{ $settings->name }}
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
            <h2 class="h2 text-center mb-4">
                @auth
                    Welcome back, {{ auth()->user()->name }}!
                @else
                    Welcome to {{ $settings->name }}!
                @endauth
            </h2>
            <div class="mt-3">
                <x-acc-alert session="success" />
                <x-acc-alert session="error" type="danger" />
                <div class="row">
                    <div class="col-12">
                        <p class="text-muted">
                            <br>
                            This is a simple and secure way to manage your account. You can easily access your account settings, view your profile, and manage your preferences.
                            <br>
                        </p>
                        @guest
                            <a class="btn btn-primary w-100" href="{{ route('login') }}">
                                <i class="fa fa-sign-in-alt"></i>
                                <span class="ms-2">
                                    Sign In
                                </span>
                            </a>
                        @endguest
                        @auth
                            <a class="btn btn-primary w-100" href="{{ route('redirect.main-app') }}">
                                <i class="fa fa-external-link-alt"></i>
                                <span class="ms-2">
                                    Redirect To Main App
                                </span>
                            </a>
                            <button class="btn btn-danger w-100 mt-2" x-on:click.prevent="
                                window.Swal.fire({
                                    title: 'Are you sure?',
                                    text: '',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        fetch('{{ route('logout') }}', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/json',
                                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                            }
                                        }).then(() => {
                                            window.location.href = '/login'
                                        })
                                    }
                                })
                            ">
                                <i class="fa fa-sign-out-alt"></i>
                                <span class="ms-2">
                                    Sign Out
                                </span>
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.>
