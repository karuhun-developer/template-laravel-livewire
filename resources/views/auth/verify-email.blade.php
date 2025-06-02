<x-layouts.auth>
    <x-slot:title>
        Verify Email
    </x-slot:title>
    <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                    <img src="{{
                        $settings->getFirstMediaUrl('logo') != ''
                            ? $settings->getFirstMediaUrl('logo')
                            : asset('img/logo.svg')
                    }}" alt="logo">
                </div>
                <h6 class="font-weight-light">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </h6>
                @if (session('status') === 'verification-link-sent')
                    <div class="mb-4 text-sm">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                            <i class="fa fa-paper-plane"></i>
                            {{ __('Resend Verification Email') }}
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}" class="mt-3">
                    @csrf
                    <button type="submit" class="btn btn-block btn-danger text-white btn-lg font-weight-medium auth-form-btn">
                        <i class="fa fa-sign-out"></i>
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.auth>
