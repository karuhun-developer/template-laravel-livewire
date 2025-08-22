<x-layouts.guest>
    <x-slot:title>
        Welcome
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
                    <h4 class="font-weight-bolder">Welcome to APP NAME</h4>
                    <p class="mb-0 text-sm">
                        This is a secure area of the application. Please confirm your password before continuing.
                    </p>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        @guest
                            <a class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0" href="{{ route('login') }}">
                                <i class="fa fa-sign-in-alt me-2"></i>
                                Login
                            </a>
                        @endguest
                        @auth
                            <a class="btn btn-lg bg-gradient-dark btn-lg w-100 mt-4 mb-0" href="{{ url('/cms') }}">
                                <i class="fa fa-briefcase me-2"></i>
                                Redirect to Dashboard
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.guest>
