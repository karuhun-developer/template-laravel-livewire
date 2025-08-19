<x-layouts.auth>
    <x-slot:title>
        Forgot Password
    </x-slot:title>
    <div class="row">
        <div
            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 start-0 text-center justify-content-center flex-column">
            <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center"
                style="
                    background-image: url('{{ asset('cassets/img/illustrations/illustration-reset.jpg') }}');
                    background-size: cover;
                ">
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column ms-auto me-auto ms-lg-auto me-lg-5">
            <div class="card card-plain">
                <div class="card-header">
                    <h4 class="font-weight-bolder">Forgot Password ?</h4>
                    <p class="mb-0 text-sm">
                        No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                    </p>
                </div>
                <div class="card-body">
                    <x-acc-alert session="status" />
                    <form method="POST" action="{{ route('password.email') }}">
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
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0">
                                <i class="fa fa-envelope me-2"></i>
                                Email Password Reset Link
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-2 text-sm mx-auto">
                        Remembered your password?
                        <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">
                            Sign in
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
