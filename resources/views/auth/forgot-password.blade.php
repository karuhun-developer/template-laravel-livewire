<x-layouts.auth>
    <x-slot:title>
        RESET PASSWORD
    </x-slot:title>
    <div class="container d-flex flex-column">
        <div class="row">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                <div class="d-table-cell align-middle">

                    <div class="text-center mt-4">
                        <p class="lead">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </p>
                    </div>

                    @if (session('status'))
                        <div class="text-success text-center mt-4">
                            {{ session('status') }}
                        </div>
                    @endif


                    <div class="m-sm-3">
                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus />
                                <x-acc-input-error for="email" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <button class="btn btn-primary">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts.auth>
