<x-layouts.app>
    <x-slot:title>
        Profile
    </x-slot:title>
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">{{ __('Profile') }}</h5>
        </div>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                    <div class="col-md-12">
                        @include('profile.partials.update-password-form')
                    </div>
                    {{-- <div class="col-md-12">
                        @include('profile.partials.delete-user-form')
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
