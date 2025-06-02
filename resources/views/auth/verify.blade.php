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
                Welcome to {{ $settings->name }} {{ $user ? $user->name : '' }}!
            </h2>
            <div class="mt-3">
                @if($user?->hasVerifiedEmail())
                    <div class="alert alert-success">
                        <strong>Success!</strong> Your email has been verified.
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <p class="text-muted">
                            <br>
                            @if($user?->hasVerifiedEmail())
                                Your email has been verified successfully.
                                <br>
                                You can now access all the features of {{ $settings->name }}.
                            @else
                                Your email is not verified.
                                <br>
                                Please check your email for the verification link.
                                <br>
                                If you did not receive the email, you can request a new one.
                            @endif
                            <br>
                        </p>
                        <a class="btn btn-primary w-100" href="{{ route('redirect.main-app') }}">
                            <i class="fa fa-external-link-alt"></i>
                            <span class="ms-2">
                                Redirect To Main App
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.>
