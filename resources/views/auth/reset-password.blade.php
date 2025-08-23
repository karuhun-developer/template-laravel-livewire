<x-layouts.guest>
    <x-slot:title>
        Reset Password
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
                    <h4 class="font-weight-bolder">Reset Password</h4>
                    <p class="mb-0 text-sm">
                        Reset your password by entering your email address below. You will receive a link to create a new password via email.
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.store') }}">
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
                        <div class="mb-3">
                            <x-acc-input type="password"
                                model="password"
                                label="Password"
                                :livewire="false"
                            />
                        </div>
                        <div class="mb-3">
                            <x-acc-input type="password"
                                model="password_confirmation"
                                label="Confirm Password"
                                :livewire="false"
                            />
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-lg bg-gradient-dark w-100 mt-4 mb-0">
                                <i class="fa fa-save me-2"></i>
                                Reset Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest>
