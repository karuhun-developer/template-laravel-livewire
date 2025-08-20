<x-layouts.guest>
    <x-slot:title>
        Reset Password
    </x-slot:title>
    <div class="row">
        <div
            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                style="
                    background-image: url('{{ asset('cassets/img/illustrations/illustration-verification.jpg') }}');
                    background-size: cover;
                ">
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
            <div class="card card-plain">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Verify Your Email</h4>
                    <p class="mb-0 text-sm">
                        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">
                                <i class="fa fa-envelope me-2"></i>
                                Resend Verification Email
                            </button>
                        </div>
                    </form>
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 text-sm text-success">
                            A new verification link has been sent to the email address you provided during registration.
                        </div>
                    @endif
                    <div class="text-center">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">
                                <i class="fa fa-sign-out-alt me-2"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest>
